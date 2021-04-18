-- Trigger 1
-- There must not exist an Admin with the same username as a Member

DROP FUNCTION IF EXISTS admin_member_identity CASCADE;
CREATE FUNCTION admin_member_identity() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT username FROM member WHERE NEW.username = member.username) THEN
        RAISE EXCEPTION 'There must not exist an Admin with the same username as a Member.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS admin_member_identity on admin CASCADE;
CREATE TRIGGER admin_member_identity
    BEFORE INSERT OR UPDATE ON admin 
    FOR EACH ROW 
    EXECUTE PROCEDURE admin_member_identity();
