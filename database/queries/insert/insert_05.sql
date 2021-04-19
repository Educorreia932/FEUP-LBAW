-- Send a message to another user
INSERT INTO message (body, thread_id, sender_id, "timestamp")
VALUES ($body, $thread_id, $sender_id, $timestamp);