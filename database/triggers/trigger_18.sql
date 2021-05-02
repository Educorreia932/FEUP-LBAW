-- Trigger 17
-- A banned member or a member without bid_permission cannot post a bid

DROP FUNCTION IF EXISTS member_bid_permission_check CASCADE;
CREATE FUNCTION member_bid_permission_check() RETURNS TRIGGER AS
$BODY$
DECLARE banned BOOLEAN;
DECLARE bid_permission BOOLEAN;
BEGIN
    SELECT member.banned, member.bid_permission
        INTO banned, bid_permission
        FROM member
        WHERE member.id = NEW.bidder_id;

    IF banned THEN
        RAISE EXCEPTION 'Member is banned.';
    END IF;

    IF NOT bid_permission THEN
        RAISE EXCEPTION 'Member does not have permission to bid.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_bid_permission_check on auction CASCADE;
CREATE TRIGGER member_bid_permission_check
    BEFORE INSERT ON bid
    FOR EACH ROW 
    EXECUTE PROCEDURE member_bid_permission_check();
