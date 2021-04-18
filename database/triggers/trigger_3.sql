-- A message's author must be a participant in the thread to which the message is being sent

DROP FUNCTION IF EXISTS message_sent CASCADE;
CREATE FUNCTION message_sent() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS (
        SELECT participant_id 
        FROM message_thread_participant 
        WHERE NEW.sender_id = message_thread_participant.participant_id AND NEW.thread_id = message_thread_participant.thread_id
    ) THEN
        RAISE EXCEPTION 'A message''s author must be a participant in the thread to which the message is being sent.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS message_sent on message CASCADE;
CREATE TRIGGER message_sent
    BEFORE INSERT ON message
    FOR EACH ROW
    EXECUTE PROCEDURE message_sent();