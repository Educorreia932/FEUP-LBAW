-- fetch bid history for a given auction
SELECT member.username as username, bid.value as value, bid.date as "date"
        FROM bid 
        INNER JOIN member 
        ON member.id = bid.bidder_id AND bid.auction_id = $auction_id
        ORDER BY value DESC LIMIT 10;