-- Whenever a user rates another, its rating must be automatically updated

-- Review

CREATE FUNCTION update_rating() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
    SET rating = rating + NEW.value
    WHERE member.id = NEW.ratee_id;
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER update_rating
    AFTER INSERT ON rating 
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating();