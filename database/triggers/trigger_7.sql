-- Whenever a user rates another, its rating must be automatically updated

-- Review

DROP FUNCTION IF EXISTS update_rating CASCADE;
CREATE FUNCTION update_rating() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
    SET rating = rating + NEW.value
    WHERE member.id = NEW.ratee_id;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating on rating CASCADE;
CREATE TRIGGER update_rating
    AFTER INSERT OR UPDATE OR DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating();