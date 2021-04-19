-- User bookmarked auctions
SELECT auction_id
    FROM bookmarked_auction
    WHERE bookmarked_auction.member_id = $member_id;