-- Users who bookmarked an auction
SELECT member_id
	FROM bookmarked_auction
	WHERE bookmarked_auction.auction_id = $auction_id;