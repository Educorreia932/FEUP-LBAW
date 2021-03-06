-- Trigger 5
-- A user can only rate another user after they have had an interaction (BR11)
-- Review this

DROP FUNCTION IF EXISTS report_user CASCADE;
CREATE FUNCTION rate_user() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS ( 
        SELECT *
        FROM bid NATURAL JOIN auction 
        WHERE 
            (auction.seller_id = NEW.ratee_id AND bid.bidder_id = NEW.rater_id)
            OR
            (auction.seller_id = NEW.rater_id AND bid.bidder_id = NEW.ratee_id)
    ) THEN
        RAISE EXCEPTION 'A user can only rate another user after they have had an interaction.';
    END IF;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS report_user on rating CASCADE;
CREATE TRIGGER rate_user
    BEFORE INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE rate_user();
