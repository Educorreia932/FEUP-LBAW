-- Trigger 2
-- There must not exist a Member with the same username as an Admin
DROP FUNCTION IF EXISTS member_admin_identity CASCADE;
CREATE FUNCTION member_admin_identity() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT username FROM admin WHERE NEW.username = admin.username) THEN
        RAISE EXCEPTION 'There must not exist a Member with the same username as an Admin.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_admin_identity on member CASCADE;
CREATE TRIGGER member_admin_identity
    BEFORE INSERT OR UPDATE ON member 
    FOR EACH ROW 
    EXECUTE PROCEDURE member_admin_identity();
