-- Trigger 9
-- When a new auction is created, a *Created Auction* notification is generated for each user that is following that auction's creator

DROP FUNCTION IF EXISTS created_auction_notification CASCADE;
CREATE FUNCTION created_auction_notification() RETURNS TRIGGER AS
$BODY$
DECLARE temprow RECORD;
DECLARE notif_id INTEGER;
BEGIN
	FOR temprow IN
        (SELECT follower_id 
		    FROM follow
                INNER JOIN auction ON follow.followed_id = auction.seller_id
		    WHERE follow.followed_id = NEW.seller_id)
    LOOP
		INSERT INTO notification (type, member_id)
			VALUES ('Created Auction', temprow.follower_id)
			RETURNING id INTO notif_id;

		INSERT INTO auction_notification (notification_id, auction_id)
		VALUES (notif_id, NEW.id);
    END LOOP;

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS created_auction_notification on auction CASCADE;
CREATE TRIGGER created_auction_notification
    AFTER INSERT ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE created_auction_notification();
