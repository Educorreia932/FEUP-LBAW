-- Place bid
INSERT INTO bid (value, "date", auction_id, bidder_id)
VALUES ($value, $date, $auction_id, $bidder_id);