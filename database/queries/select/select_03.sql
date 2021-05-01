-- User search results
SELECT member.id, ts_rank(member.ts_search, plainto_tsquery('english', $search_text)) as "rank"
FROM member
	INNER JOIN follow ON follow.follower_id = $user_id AND member.id = follow.followed_id
	INNER JOIN auction ON auction.seller_id = member.id
WHERE
	member.rating >= $min_rating AND
	member.joined >= $min_join_date AND
	member.joined <= $max_join_date AND
	member.ts_search @@ plainto_tsquery('english', $search_text)
GROUP BY member.id
ORDER BY "rank" DESC;


-- Auction search results
SELECT auction.id, ts_rank(auction.ts_search, plainto_tsquery('english', $text_search)) as "rank"
    FROM auction
		INNER JOIN follow ON follow.follower_id = $user_id AND auction.seller_id = follow.followed_id
		INNER JOIN bid ON auction.latest_bid = bid.id
	WHERE
		auction.category IN ($category1, $category2, ...) AND
		auction.status IN ($status1, $status2) AND
		bid.value >= $min_bid_value::money AND
		bid.value <= $max_bid_value::money AND
		auction.ts_search @@ plainto_tsquery('english', $text_search)
	ORDER BY "rank" DESC;