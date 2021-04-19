-- Create new auction
INSERT INTO auction (title, description, starting_bid, increment_fixed, increment_percent, start_date, end_date, status, category, nsfw, seller_id)
VALUES ($title, $description, $starting_bid, $increment_fixed, $increment_percent, $start_date, $end_date, $status, $category, $nsfw, $seller_id);