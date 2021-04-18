-- A member cannot bid in their own auction (BR01)

DROP FUNCTION IF EXISTS self_bidding CASCADE;
CREATE FUNCTION self_bidding() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT seller_id FROM auction WHERE NEW.bidder_id = auction.seller_id ) THEN
        RAISE EXCEPTION 'A member cannot bid in their own auction.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS self_bidding on bid CASCADE;
CREATE TRIGGER self_bidding
    BEFORE INSERT ON bid
    FOR EACH ROW 
    EXECUTE PROCEDURE self_bidding();