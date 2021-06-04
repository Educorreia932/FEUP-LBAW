-- Trigger 13
-- When a user receives a new message, a *Message Received* notification is generated for that user

DROP FUNCTION IF EXISTS message_received_notification CASCADE;
CREATE FUNCTION message_received_notification() RETURNS TRIGGER AS
$BODY$
DECLARE temprow RECORD;
DECLARE notif_id INTEGER;
BEGIN
	FOR temprow IN
        SELECT participant_id 
		FROM message_thread_participant
		WHERE thread_id = NEW.thread_id
    LOOP
		IF NEW.sender_id <> temprow.participant_id THEN
			INSERT INTO notification (type, member_id)
				VALUES ('Message Received', temprow.participant_id)
				RETURNING id INTO notif_id; 

			INSERT INTO message_notification (notification_id, message_id)
			VALUES (notif_id, NEW.id);
		END IF;
	END LOOP;

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS message_received_notification on message CASCADE;
CREATE TRIGGER message_received_notification 
    AFTER INSERT ON message
    FOR EACH ROW
    EXECUTE PROCEDURE message_received_notification();
