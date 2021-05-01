-- Recently biddded auctions
SELECT auction.title, auction.latest_bid, auction.end_date, MAX(bid.value)
FROM    auction 
        INNER JOIN
        (bid INNER JOIN member ON bid.bidder_id = member.id)
        ON auction.id = bid.auction_id

WHERE $user_id = member.id AND auction.status = 'Active' AND bid."date" > now()::TIMESTAMP - INTERVAL '1 week'
GROUP BY auction.id
ORDER BY MAX(bid.date) DESC
LIMIT 5;