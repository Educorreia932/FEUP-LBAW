-- A user can only report another user after they have had an interaction (BR12)

-- Review this

DROP FUNCTION IF EXISTS report_user CASCADE;
CREATE FUNCTION report_user() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS ( 
        SELECT * 
        FROM bid NATURAL JOIN auction 
        WHERE 
            NEW.reason = 'Fraud'::user_report_reason 
            AND
            (auction.seller_id = NEW.reportee_id AND bid.bidder_id = NEW.reporter_id)
    ) THEN
        RAISE EXCEPTION 'A user can only report another user after they have had an interaction.';
    END IF;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS report_user on user_report CASCADE;
CREATE TRIGGER report_user
    BEFORE INSERT ON user_report
    FOR EACH ROW
    EXECUTE PROCEDURE report_user();