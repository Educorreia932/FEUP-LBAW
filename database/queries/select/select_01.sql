-- Detailed auction access
SELECT auction.id, auction.title, auction.description, auction.starting_bid, auction.increment_fixed, auction.increment_percent,
        auction.start_date, auction.end_date, auction.status, auction.nsfw, auction.latest_bid, member.name, member.rating
FROM auction INNER JOIN member ON auction.seller_id = member.id WHERE auction.id = $auction_id;