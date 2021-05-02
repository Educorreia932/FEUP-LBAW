-- Trigger 16
-- Pre-calculate message ts vector
DROP FUNCTION IF EXISTS message_tsvector CASCADE;
CREATE FUNCTION message_tsvector() RETURNS TRIGGER AS 
$BODY$
DECLARE member_username TEXT;
DECLARE member_name TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        IF OLD.body = NEW.body THEN
            RETURN NEW;
        END IF;
    END IF;

    NEW.ts_search = setweight(to_tsvector('english', coalesce(NEW.body,'')), 'A');

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS message_tsvector on message CASCADE;
CREATE TRIGGER message_tsvector
    BEFORE INSERT OR UPDATE ON message 
    FOR EACH ROW 
    EXECUTE PROCEDURE message_tsvector();
