-- When a new auction is created, a *Created Auction* notification is generated for each user that is following that auction's creator

CREATE FUNCTION created_auction_notification() RETURNS TRIGGER AS
$BODY$
DECLARE 
	temprow RECORD;
BEGIN
	FOR temprow IN
        (SELECT follower_id 
		    FROM follow
                INNER JOIN auction ON follow.followed_id = auction.seller_id
		    WHERE follow.followed_id = NEW.seller_id)
    LOOP
        WITH notification_id AS (
			INSERT INTO notification (type, member_id)
			VALUES ('Created Auction', temprow.follower_id)
			RETURNING id 
		)

		INSERT INTO auction_notification (notification_id, auction_id)
		VALUES (notification_id, NEW.id);
    END LOOP;	
END
$BODY$
LANGUAGE plpgsql;

CREATE TRIGGER created_auction_notification
    AFTER INSERT ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE created_auction_notification();