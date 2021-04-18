-- When a user receives a new follower, a *User Followed* notification is generated for that user

DROP FUNCTION IF EXISTS user_followed_notification CASCADE;
CREATE FUNCTION user_followed_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
	WITH notification_id AS (
		INSERT INTO notification (notification_type, member_id)
		VALUES ('User Followed', NEW.followed_id)
		RETURNING id 
	)

	INSERT INTO user_notification (notification_id, member_id)
	VALUES (notification_id, NEW.follower_id);
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_followed_notification on follow CASCADE;
CREATE TRIGGER user_followed_notification 
    AFTER INSERT ON follow
    FOR EACH ROW