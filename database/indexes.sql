-- Regular indexes
CREATE INDEX bid_auction_index on bid USING hash(auction_id);
CREATE INDEX bid_bidder_index on bid USING hash(bidder_id);
CREATE INDEX message_thread_index on message USING hash(thread_id);
CREATE INDEX image_auction_index on auction_image USING hash(auction_id);
CREATE INDEX bookmark_member_index on bookmarked_auction USING hash(member_id);
CREATE INDEX bookmark_auction_index on bookmarked_auction USING hash(auction_id);

-- FTS indexes
CREATE INDEX auction_tsvector_index ON auction USING GIN(ts_search);
CREATE INDEX member_tsvector_index ON member USING GIN(ts_search);
CREATE INDEX message_tsvector_index ON message USING GIST(ts_search);
