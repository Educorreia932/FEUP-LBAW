-- Trigger 19
-- Set the next_bid to the starting_bid

DROP FUNCTION IF EXISTS default_next_bid CASCADE;
CREATE FUNCTION default_next_bid() RETURNS TRIGGER AS
$BODY$
BEGIN
    NEW.next_bid = NEW.starting_bid;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS default_next_bid on auction CASCADE;
CREATE TRIGGER default_next_bid
    BEFORE INSERT ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE default_next_bid();
