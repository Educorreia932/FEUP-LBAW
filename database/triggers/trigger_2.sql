-- There must not exist a Member with the same username as an Admin

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

CREATE TRIGGER member_admin_identity
    BEFORE INSERT OR UPDATE ON member 
    FOR EACH ROW 
    EXECUTE PROCEDURE admin_member_identity();