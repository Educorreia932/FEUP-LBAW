-- Trigger 15
-- Pre-calculate user ts vector
DROP FUNCTION IF EXISTS member_tsvector CASCADE;
CREATE FUNCTION member_tsvector() RETURNS TRIGGER AS 
$BODY$
DECLARE member_username TEXT;
DECLARE member_name TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        IF OLD.username <> NEW.username OR OLD.name <> NEW.name OR OLD.bio <> NEW.bio THEN
            NEW.ts_search =
                setweight(to_tsvector('english', coalesce(NEW.username,'')), 'A') ||
                setweight(to_tsvector('english', coalesce(NEW.name,'')), 'B') ||
                setweight(to_tsvector('english', coalesce(NEW.bio,'')), 'C');
        END IF;
        IF OLD.username <> NEW.username OR OLD.name <> NEW.name THEN
            UPDATE auction
                SET ts_search =
                    setweight(to_tsvector('english', coalesce(title,'')), 'A')    ||
                    setweight(to_tsvector('english', coalesce(description,'')), 'B')  ||
                    setweight(to_tsvector('english', coalesce(NEW.username,'')), 'C') ||
                    setweight(to_tsvector('english', coalesce(NEW.name,'')), 'D')
                WHERE seller_id = NEW.id;
        END IF;
    END IF;

    IF TG_OP = 'INSERT' THEN
        NEW.ts_search =
            setweight(to_tsvector('english', coalesce(NEW.username,'')), 'A') ||
            setweight(to_tsvector('english', coalesce(NEW.name,'')), 'B') ||
            setweight(to_tsvector('english', coalesce(NEW.bio,'')), 'C');
    END IF;

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_tsvector on member CASCADE;
CREATE TRIGGER member_tsvector
    BEFORE INSERT OR UPDATE ON member 
    FOR EACH ROW 
    EXECUTE PROCEDURE member_tsvector();
