-- Auction's images
SELECT id
	FROM auction_image
	WHERE auction_image.auction_id = $auction_id;