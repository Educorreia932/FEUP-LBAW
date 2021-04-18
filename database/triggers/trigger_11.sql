-- When a user's bookmarked auction starts, a *Bookmarked Auction* notification is generated for that user

DROP FUNCTION IF EXISTS bookmarked_auction_notification CASCADE;
CREATE FUNCTION bookmarked_auction_notification() RETURNS TRIGGER AS
$BODY$
DECLARE 
	temprow RECORD;
BEGIN
	FOR temprow IN
        SELECT member_id
		FROM bookmarked_auction
		WHERE auction_id = NEW.id
    LOOP
		IF NEW.status = "Open" AND OLD.status = "Scheduled" THEN
			WITH notification_id AS (
				INSERT INTO notification (notification_type, member_id)
				VALUES ('Bookmarked Auction', temprow.member_id)
				RETURNING id 
			)

			INSERT INTO auction_notification (notification_id, auction_id)
				VALUES (notification_id, NEW.id);
		END IF;
	END LOOP;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bookmarked_auction_notification on auction CASCADE;
CREATE TRIGGER bookmarked_auction_notification
	AFTER UPDATE ON auction
	FOR EACH ROW
	EXECUTE PROCEDURE bookmarked_auction_notification()