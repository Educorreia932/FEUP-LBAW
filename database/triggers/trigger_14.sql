-- Trigger 14
-- Pre-calculate auction ts vector
DROP FUNCTION IF EXISTS auction_tsvector CASCADE;
CREATE FUNCTION auction_tsvector() RETURNS TRIGGER AS 
$BODY$
DECLARE member_username TEXT;
DECLARE member_name TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        IF OLD.title = NEW.title AND OLD.description = NEW.description THEN
            RETURN NEW;
        END IF;
    END IF;

    SELECT member.username, member.name
        INTO member_username, member_name
        FROM member
        WHERE member.id = NEW.seller_id;

    NEW.ts_search =
        setweight(to_tsvector('english', coalesce(NEW.title,'')), 'A')    ||
        setweight(to_tsvector('english', coalesce(NEW.description,'')), 'B')  ||
        setweight(to_tsvector('english', coalesce(member_username,'')), 'C') ||
        setweight(to_tsvector('english', coalesce(member_name,'')), 'D');

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_tsvector on auction CASCADE;
CREATE TRIGGER auction_tsvector
    BEFORE INSERT OR UPDATE ON auction 
    FOR EACH ROW 
    EXECUTE PROCEDURE auction_tsvector();
