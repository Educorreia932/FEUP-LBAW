-- Trigger 17
-- A banned member or a member without sell_permission cannot post an auction

DROP FUNCTION IF EXISTS member_auction_permission_check CASCADE;
CREATE FUNCTION member_auction_permission_check() RETURNS TRIGGER AS
$BODY$
DECLARE banned BOOLEAN;
DECLARE sell_permission BOOLEAN;
BEGIN
    SELECT member.banned, member.sell_permission
        INTO banned, sell_permission
        FROM member
        WHERE member.id = NEW.seller_id;

    IF banned THEN
        RAISE EXCEPTION 'Member is banned.';
    END IF;

    IF NOT sell_permission THEN
        RAISE EXCEPTION 'Member does not have permission to sell.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_auction_permission_check on auction CASCADE;
CREATE TRIGGER member_auction_permission_check
    BEFORE INSERT ON auction
    FOR EACH ROW 
    EXECUTE PROCEDURE member_auction_permission_check();
