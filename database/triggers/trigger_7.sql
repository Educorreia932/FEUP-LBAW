-- Trigger 7
-- Whenever a user rates another, its rating must be automatically updated

-- Review
DROP FUNCTION IF EXISTS update_rating_insert CASCADE;
CREATE FUNCTION update_rating_insert() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
        SET rating = rating + NEW.value
        WHERE member.id = NEW.ratee_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating_insert on rating CASCADE;
CREATE TRIGGER update_rating_insert
    AFTER INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating_insert();

DROP FUNCTION IF EXISTS update_rating_update CASCADE;
CREATE FUNCTION update_rating_update() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
        SET rating = rating - OLD.value + NEW.value
        WHERE member.id = NEW.ratee_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating_update on rating CASCADE;
CREATE TRIGGER update_rating_update
    AFTER UPDATE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating_update();


DROP FUNCTION IF EXISTS update_rating_delete CASCADE;
CREATE FUNCTION update_rating_delete() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
        SET rating = rating - OLD.value
        WHERE member.id = OLD.ratee_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating_delete on rating CASCADE;
CREATE TRIGGER update_rating_delete
    AFTER DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating_delete();
