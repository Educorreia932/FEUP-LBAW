-- Trigger 6
-- Set the most recent bid reference on the auction and update the next_bid

DROP FUNCTION IF EXISTS most_recent_bid CASCADE;
CREATE FUNCTION most_recent_bid() RETURNS TRIGGER AS
$BODY$
BEGIN

    UPDATE auction
        SET latest_bid = NEW.id,
            next_bid = COALESCE(NEW.value + increment_fixed, CEIL(NEW.value * (100 + increment_percent) / 100.0))
        WHERE auction.id = NEW.auction_id;

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS most_recent_bid on bid CASCADE;
CREATE TRIGGER most_recent_bid
    AFTER INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE most_recent_bid();
