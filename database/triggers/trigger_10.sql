-- When a user is outbidded in an auction they bidded on, an *Auction Outbid* notification is generated for that user

DROP FUNCTION IF EXISTS auction_outbid_notification CASCADE;
CREATE FUNCTION auction_outbid_notification() RETURNS TRIGGER AS
$BODY$
BEGIN
    WITH member_id AS (
        SELECT bidder_id
            FROM bid
            WHERE bid.auction_id = NEW.auction_id
                AND bid.bidder_id != NEW.bidder_id
                AND "date" = (
                    SELECT MAX("date")
                        FROM bid
                            WHERE bid.auction_id = NEW.auction_id
                            AND bid.bidder_id != NEW.bidder_id
                    )
    )
    IF member_id IS NOT NULL THEN 
        WITH notification_id AS (
            INSERT INTO notification(type, member_id)
                VALUES ('Auction Outbid', member_id)
            RETURNING id
        )
        INSERT INTO auction_notification(notification_id, auction_id)
            VALUES (notification_id, NEW.auction_id)
    END IF;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_outbid_notification on bid CASCADE;
CREATE TRIGGER auction_outbid_notification
    AFTER INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE auction_outbid_notification()