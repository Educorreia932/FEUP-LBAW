-- Trigger 11
-- When a user's bookmarked auction starts, a *Bookmarked Auction* notification is generated for that user

DROP FUNCTION IF EXISTS bookmarked_auction_notification CASCADE;
CREATE FUNCTION bookmarked_auction_notification() RETURNS TRIGGER AS
$BODY$
DECLARE temprow RECORD;
DECLARE notif_id INTEGER;
BEGIN
	FOR temprow IN
        SELECT member_id
		FROM bookmarked_auction
		WHERE auction_id = NEW.id
    LOOP
		IF NEW.status::text = 'Open' AND OLD.status::text = 'Scheduled' THEN

            INSERT INTO notification (type, member_id)
				VALUES ('Bookmarked Auction', temprow.member_id)
				RETURNING id INTO notif_id;

			INSERT INTO auction_notification (notification_id, auction_id)
				VALUES (notif_id, NEW.id);
		END IF;
	END LOOP;

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bookmarked_auction_notification on auction CASCADE;
CREATE TRIGGER bookmarked_auction_notification
	AFTER UPDATE ON auction
	FOR EACH ROW
	EXECUTE PROCEDURE bookmarked_auction_notification();
