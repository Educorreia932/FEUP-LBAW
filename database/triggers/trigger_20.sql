-- Trigger 20
-- Set the last_message in the thread

DROP FUNCTION IF EXISTS most_recent_message CASCADE;
CREATE FUNCTION most_recent_message() RETURNS TRIGGER AS
$BODY$
BEGIN

    UPDATE message_thread
        SET latest_message = NEW.id
        WHERE message_thread.id = NEW.thread_id;

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS most_recent_message on message CASCADE;
CREATE TRIGGER most_recent_message
    AFTER INSERT ON message
    FOR EACH ROW
    EXECUTE PROCEDURE most_recent_message();
