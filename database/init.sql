DROP TYPE IF EXISTS auction_category CASCADE;
DROP TYPE IF EXISTS auction_status CASCADE;
DROP TYPE IF EXISTS auction_report_reason CASCADE;
DROP TYPE IF EXISTS user_report_reason CASCADE;
DROP TYPE IF EXISTS notification_type CASCADE;

DROP TABLE IF EXISTS member CASCADE;
DROP TABLE IF EXISTS auction CASCADE;
DROP TABLE IF EXISTS follow CASCADE;
DROP TABLE IF EXISTS bid CASCADE;
DROP TABLE IF EXISTS message_thread CASCADE;
DROP TABLE IF EXISTS message_thread_participant CASCADE;
DROP TABLE IF EXISTS message CASCADE;
DROP TABLE IF EXISTS auction_report CASCADE;
DROP TABLE IF EXISTS user_report CASCADE;
DROP TABLE IF EXISTS rating CASCADE;
DROP TABLE IF EXISTS admin CASCADE;
DROP TABLE IF EXISTS bookmarked_auction CASCADE;
DROP TABLE IF EXISTS notification CASCADE;
DROP TABLE IF EXISTS auction_notification CASCADE;
DROP TABLE IF EXISTS user_notification CASCADE;
DROP TABLE IF EXISTS message_notification CASCADE;
DROP TABLE IF EXISTS auction_image CASCADE;

-- Types

CREATE TYPE auction_category AS ENUM ( 'Games', 'Software', 'E-Books', 'Skins', 'Music', 'Series & Movies', 'Comics & Manga', 'Others' );

CREATE TYPE auction_status AS ENUM ( 'Active', 'Closed', 'Scheduled', 'Canceled', 'Frozen', 'Terminated' );

CREATE TYPE auction_report_reason AS ENUM ( 'Fraudalent Auction', 'Improper product pictures', 'Improper auction title', 'Other' );

CREATE TYPE user_report_reason AS ENUM ( 'Fraud', 'Improper profile image', 'Improper username', 'Other' );

CREATE TYPE notification_type AS ENUM ( 'User Followed', 'Message Received', 'Created Auction', 'Auction Outbid', 'Bookmarked Auction' );

-- Tables

CREATE TABLE member (
    id                                  SERIAL PRIMARY KEY,
    username                            TEXT UNIQUE,
    email                               TEXT UNIQUE,
    password                            TEXT,
    name                                TEXT,
    bio                                 TEXT,
    joined                              TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    credit                              MONEY NOT NULL CONSTRAINT credit_ck CHECK (credit >= 0::MONEY),
    rating                              INTEGER DEFAULT 0 NOT NULL,
    data_consent                        BOOLEAN DEFAULT FALSE NOT NULL,
    notifications                       BOOLEAN DEFAULT TRUE NOT NULL,
    outbid_notifications                BOOLEAN DEFAULT TRUE NOT NULL,
    start_auction_notifications         BOOLEAN DEFAULT TRUE NOT NULL,
    followed_user_activity              BOOLEAN DEFAULT TRUE NOT NULL,
    bid_permission                      BOOLEAN DEFAULT TRUE NOT NULL,
    sell_permission                     BOOLEAN DEFAULT TRUE NOT NULL,
    banned                              BOOLEAN DEFAULT FALSE NOT NULL,
    ts_search                           TSVECTOR DEFAULT NULL
);

CREATE TABLE auction (
    id                              SERIAL PRIMARY KEY,
    title                           TEXT NOT NULL,
    description                     TEXT NOT NULL,
    starting_bid                    MONEY NOT NULL CONSTRAINT starting_bid_ck CHECK (starting_bid >= 0::MONEY),
    increment_fixed                 MONEY CONSTRAINT increment_fixed_ck CHECK (increment_fixed IS NULL OR increment_fixed > 0::MONEY),
    increment_percent               REAL CONSTRAINT increment_percent_ck CHECK (increment_percent IS NULL OR (increment_percent > 0 AND increment_percent <= 0.5)),
    start_date                      TIMESTAMP WITH TIME ZONE NOT NULL,
    end_date                        TIMESTAMP WITH TIME ZONE NOT NULL,
    status                          auction_status NOT NULL,
    category                        auction_category NOT NULL,
    nsfw                            BOOLEAN NOT NULL DEFAULT FALSE,
    seller_id                       INTEGER REFERENCES member(id) NOT NULL,
    latest_bid                      INTEGER DEFAULT NULL,
    ts_search                       TSVECTOR DEFAULT NULL,
    CONSTRAINT increment_xor_ck     CHECK ((increment_fixed IS NULL AND increment_percent IS NOT NULL) OR (increment_fixed IS NOT NULL AND increment_percent IS NULL)),
    CONSTRAINT dates_ck             CHECK (end_date > start_date)
);

CREATE TABLE bid (
    id                      SERIAL PRIMARY KEY,
    value                   MONEY NOT NULL CONSTRAINT value CHECK (value >= 0::MONEY),
    "date"                  TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    auction_id              INTEGER REFERENCES auction(id) NOT NULL,
    bidder_id               INTEGER REFERENCES member(id) NOT NULL
);

ALTER TABLE auction ADD CONSTRAINT bid_foreign_key FOREIGN KEY(latest_bid) REFERENCES bid(id);

CREATE TABLE follow (       
    follower_id                INTEGER REFERENCES member(id) NOT NULL,
    followed_id                INTEGER REFERENCES member(id) NOT NULL,
    CONSTRAINT member_ck CHECK (follower_id != followed_id),
    PRIMARY KEY (follower_id, followed_id)
);

CREATE TABLE message_thread (
    id                      SERIAL PRIMARY KEY
);

CREATE TABLE message_thread_participant (
    thread_id           INTEGER REFERENCES message_thread(id) NOT NULL,
    participant_id      INTEGER REFERENCES member(id) NOT NULL,
    PRIMARY KEY (thread_id, participant_id)
);

CREATE TABLE message (
    id                     SERIAL PRIMARY KEY,
    body                   TEXT NOT NULL,
    thread_id              INTEGER REFERENCES message_thread(id) NOT NULL,
    sender_id              INTEGER REFERENCES member(id) NOT NULL,
    "timestamp"            TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    ts_search              TSVECTOR DEFAULT NULL
);

CREATE TABLE auction_report (
    id                      SERIAL PRIMARY KEY,
    reason                  auction_report_reason NOT NULL,
    description             TEXT,
    "timestamp"             TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    reporter_id             INTEGER REFERENCES member(id) NOT NULL,
    reported_id             INTEGER REFERENCES auction(id) NOT NULL
);

CREATE TABLE user_report (
    id                     SERIAL PRIMARY KEY,
    reason                 user_report_reason NOT NULL,
    description            TEXT,
    "timestamp"            TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    reporter_id            INTEGER REFERENCES member(id) NOT NULL,
    reported_id            INTEGER REFERENCES member(id) NOT NULL,
    CONSTRAINT same_user_ck CHECK (reporter_id != reported_id)
);

CREATE TABLE rating (
    value                INTEGER NOT NULL,
    ratee_id             INTEGER REFERENCES MEMBER(id) NOT NULL,
    rater_id             INTEGER REFERENCES MEMBER(id) NOT NULL,
    CONSTRAINT value_ck  CHECK (value = -1 OR value = 1),
    CONSTRAINT member_ck CHECK (ratee_id != rater_id),
    PRIMARY KEY (rater_id, ratee_id)
);

CREATE TABLE admin (
	id          SERIAL PRIMARY KEY,
	username    TEXT UNIQUE,
	password    TEXT
);

CREATE TABLE bookmarked_auction (
    auction_id       INTEGER REFERENCES auction(id) NOT NULL,
    member_id        INTEGER REFERENCES member(id) NOT NULL,
    PRIMARY KEY (auction_id, member_id)
);

CREATE TABLE notification (
    id              SERIAL PRIMARY KEY,
    type            notification_type NOT NULL,
    time            TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    read            BOOLEAN NOT NULL DEFAULT FALSE,
    member_id       INTEGER REFERENCES member(id)
);

CREATE TABLE auction_notification (
    notification_id     INTEGER REFERENCES notification(id),
    auction_id          INTEGER REFERENCES auction(id),
    PRIMARY KEY (notification_id, auction_id)
);

CREATE TABLE user_notification (
    notification_id      INTEGER REFERENCES notification(id),
    member_id            INTEGER REFERENCES member(id),
    PRIMARY KEY (notification_id, member_id)
);

CREATE TABLE message_notification (
    notification_id      INTEGER REFERENCES notification(id),
    message_id           INTEGER REFERENCES message(id),
    PRIMARY KEY (notification_id, message_id)
);

CREATE TABLE auction_image (
    id                    SERIAL PRIMARY KEY,
    auction_id            INTEGER REFERENCES auction(id) NOT NULL
);

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
-- Trigger 10
-- When a user is outbidded in an auction they bidded on, an *Auction Outbid* notification is generated for that user

DROP FUNCTION IF EXISTS auction_outbid_notification CASCADE;
CREATE FUNCTION auction_outbid_notification() RETURNS TRIGGER AS
$BODY$
DECLARE notif_id INTEGER;
DECLARE member_id INTEGER;
BEGIN
    SELECT bidder_id INTO member_id
        FROM bid
        WHERE bid.auction_id = NEW.auction_id
            AND bid.bidder_id != NEW.bidder_id
            AND "date" = (
                SELECT MAX("date")
                    FROM bid
                        WHERE bid.auction_id = NEW.auction_id
                        AND bid.bidder_id != NEW.bidder_id
                );
    IF member_id IS NOT NULL THEN
		INSERT INTO notification(type, member_id)
			VALUES ('Auction Outbid', member_id)
            RETURNING id INTO notif_id;
        INSERT INTO auction_notification(notification_id, auction_id)
            VALUES (notif_id, NEW.auction_id);
    END IF;
	
	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_outbid_notification on bid CASCADE;
CREATE TRIGGER auction_outbid_notification
    AFTER INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE auction_outbid_notification();
-- Trigger 11
-- When a user's bookmarked auction starts, a *Bookmarked Auction* notification is generated for that user

DROP FUNCTION IF EXISTS bookmarked_auction_notification CASCADE;
CREATE FUNCTION bookmarked_auction_notification() RETURNS TRIGGER AS
$BODY$
DECLARE 
	temprow RECORD;
BEGIN
	FOR temprow IN
        SELECT member_id
		FROM bookmarked_auction
		WHERE auction_id = NEW.id
    LOOP
		IF NEW.status = "Open" AND OLD.status = "Scheduled" THEN
			WITH notification_id AS (
				INSERT INTO notification (type, member_id)
				VALUES ('Bookmarked Auction', temprow.member_id)
				RETURNING id 
			)

			INSERT INTO auction_notification (notification_id, auction_id)
				VALUES (notification_id, NEW.id);
		END IF;
	END LOOP;

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS bookmarked_auction_notification on auction CASCADE;
CREATE TRIGGER bookmarked_auction_notification
	AFTER UPDATE ON auction
	FOR EACH ROW
	EXECUTE PROCEDURE bookmarked_auction_notification();
-- Trigger 12
-- When a user receives a new follower, a *User Followed* notification is generated for that user

DROP FUNCTION IF EXISTS user_followed_notification CASCADE;
CREATE FUNCTION user_followed_notification() RETURNS TRIGGER AS
$BODY$
DECLARE notif_id INTEGER;
BEGIN
	INSERT INTO notification (type, member_id)
		VALUES ('User Followed', NEW.followed_id)
		RETURNING id INTO notif_id;

	INSERT INTO user_notification (notification_id, member_id)
		VALUES (notif_id, NEW.follower_id);

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS user_followed_notification on follow CASCADE;
CREATE TRIGGER user_followed_notification 
    AFTER INSERT ON follow
    FOR EACH ROW
	EXECUTE PROCEDURE user_followed_notification();
-- Trigger 13
-- When a user receives a new message, a *Message Received* notification is generated for that user

DROP FUNCTION IF EXISTS message_received_notification CASCADE;
CREATE FUNCTION message_received_notification() RETURNS TRIGGER AS
$BODY$
DECLARE temprow RECORD;
DECLARE notif_id INTEGER;
BEGIN
	FOR temprow IN
        SELECT participant_id 
		FROM message_thread_participant
		WHERE thread_id = NEW.thread_id
    LOOP
		IF NEW.sender_id <> temprow.participant_id THEN
			INSERT INTO notification (type, member_id)
				VALUES ('Message Received', temprow.participant_id)
				RETURNING id INTO notif_id; 

			INSERT INTO message_notification (notification_id, message_id)
			VALUES (notif_id, NEW.id);
		END IF;
	END LOOP;

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS message_received_notification on message CASCADE;
CREATE TRIGGER message_received_notification 
    AFTER INSERT ON message
    FOR EACH ROW
    EXECUTE PROCEDURE message_received_notification();
-- Trigger 14
-- Pre-calculate auction ts vector
DROP FUNCTION IF EXISTS auction_tsvector CASCADE;
CREATE FUNCTION auction_tsvector() RETURNS TRIGGER AS 
$BODY$
DECLARE member_username TEXT;
DECLARE member_name TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        IF OLD.title = NEW.title AND OLD.description = NEW.description THEN
            RETURN NEW;
        END IF;
    END IF;

    SELECT member.username, member.name
        INTO member_username, member_name
        FROM member
        WHERE member.id = NEW.seller_id;

    NEW.ts_search =
        setweight(to_tsvector('english', coalesce(NEW.title,'')), 'A')    ||
        setweight(to_tsvector('english', coalesce(NEW.description,'')), 'B')  ||
        setweight(to_tsvector('english', coalesce(member_username,'')), 'C') ||
        setweight(to_tsvector('english', coalesce(member_name,'')), 'D');

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS auction_tsvector on auction CASCADE;
CREATE TRIGGER auction_tsvector
    BEFORE INSERT OR UPDATE ON auction 
    FOR EACH ROW 
    EXECUTE PROCEDURE auction_tsvector();
-- Trigger 15
-- Pre-calculate user ts vector
DROP FUNCTION IF EXISTS member_tsvector CASCADE;
CREATE FUNCTION member_tsvector() RETURNS TRIGGER AS 
$BODY$
DECLARE member_username TEXT;
DECLARE member_name TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        IF OLD.username <> NEW.username OR OLD.name <> NEW.name OR OLD.bio <> NEW.bio THEN
            NEW.ts_search =
                setweight(to_tsvector('english', coalesce(NEW.username,'')), 'A') ||
                setweight(to_tsvector('english', coalesce(NEW.name,'')), 'B') ||
                setweight(to_tsvector('english', coalesce(NEW.bio,'')), 'C');
        END IF;
        IF OLD.username <> NEW.username OR OLD.name <> NEW.name THEN
            UPDATE auction
                SET auction.ts_search =
                    setweight(to_tsvector('english', coalesce(auction.title,'')), 'A')    ||
                    setweight(to_tsvector('english', coalesce(auction.description,'')), 'B')  ||
                    setweight(to_tsvector('english', coalesce(NEW.username,'')), 'C') ||
                    setweight(to_tsvector('english', coalesce(NEW.name,'')), 'D')
                WHERE auction.seller_id = NEW.id;
        END IF;
    END IF;

    IF TG_OP = 'INSERT' THEN
        NEW.ts_search =
            setweight(to_tsvector('english', coalesce(NEW.username,'')), 'A') ||
            setweight(to_tsvector('english', coalesce(NEW.name,'')), 'B') ||
            setweight(to_tsvector('english', coalesce(NEW.bio,'')), 'C');
    END IF;

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_tsvector on member CASCADE;
CREATE TRIGGER member_tsvector
    BEFORE INSERT OR UPDATE ON member 
    FOR EACH ROW 
    EXECUTE PROCEDURE member_tsvector();
-- Trigger 16
-- Pre-calculate message ts vector
DROP FUNCTION IF EXISTS message_tsvector CASCADE;
CREATE FUNCTION message_tsvector() RETURNS TRIGGER AS 
$BODY$
DECLARE member_username TEXT;
DECLARE member_name TEXT;
BEGIN
    IF TG_OP = 'UPDATE' THEN
        IF OLD.body = NEW.body THEN
            RETURN NEW;
        END IF;
    END IF;

    NEW.ts_search = setweight(to_tsvector('english', coalesce(NEW.body,'')), 'A');

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS message_tsvector on message CASCADE;
CREATE TRIGGER message_tsvector
    BEFORE INSERT OR UPDATE ON message 
    FOR EACH ROW 
    EXECUTE PROCEDURE message_tsvector();
-- Trigger 17
-- A banned member or a member without sell_permission cannot post an auction

DROP FUNCTION IF EXISTS member_auction_permission_check CASCADE;
CREATE FUNCTION member_auction_permission_check() RETURNS TRIGGER AS
$BODY$
DECLARE banned BOOLEAN;
DECLARE sell_permission BOOLEAN;
BEGIN
    SELECT member.banned, member.sell_permission
        INTO banned, sell_permission
        FROM member
        WHERE member.id = NEW.seller_id;

    IF banned THEN
        RAISE EXCEPTION 'Member is banned.';
    END IF;

    IF NOT sell_permission THEN
        RAISE EXCEPTION 'Member does not have permission to sell.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_auction_permission_check on auction CASCADE;
CREATE TRIGGER member_auction_permission_check
    BEFORE INSERT ON auction
    FOR EACH ROW 
    EXECUTE PROCEDURE member_auction_permission_check();
-- Trigger 17
-- A banned member or a member without bid_permission cannot post a bid

DROP FUNCTION IF EXISTS member_bid_permission_check CASCADE;
CREATE FUNCTION member_bid_permission_check() RETURNS TRIGGER AS
$BODY$
DECLARE banned BOOLEAN;
DECLARE bid_permission BOOLEAN;
BEGIN
    SELECT member.banned, member.bid_permission
        INTO banned, bid_permission
        FROM member
        WHERE member.id = NEW.bidder_id;

    IF banned THEN
        RAISE EXCEPTION 'Member is banned.';
    END IF;

    IF NOT bid_permission THEN
        RAISE EXCEPTION 'Member does not have permission to bid.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_bid_permission_check on auction CASCADE;
CREATE TRIGGER member_bid_permission_check
    BEFORE INSERT ON bid
    FOR EACH ROW 
    EXECUTE PROCEDURE member_bid_permission_check();
-- Trigger 1
-- There must not exist an Admin with the same username as a Member

DROP FUNCTION IF EXISTS admin_member_identity CASCADE;
CREATE FUNCTION admin_member_identity() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT username FROM member WHERE NEW.username = member.username) THEN
        RAISE EXCEPTION 'There must not exist an Admin with the same username as a Member.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS admin_member_identity on admin CASCADE;
CREATE TRIGGER admin_member_identity
    BEFORE INSERT OR UPDATE ON admin 
    FOR EACH ROW 
    EXECUTE PROCEDURE admin_member_identity();
-- Trigger 2
-- There must not exist a Member with the same username as an Admin
DROP FUNCTION IF EXISTS member_admin_identity CASCADE;
CREATE FUNCTION member_admin_identity() RETURNS TRIGGER AS 
$BODY$
BEGIN
    IF EXISTS (SELECT username FROM admin WHERE NEW.username = admin.username) THEN
        RAISE EXCEPTION 'There must not exist a Member with the same username as an Admin.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS member_admin_identity on member CASCADE;
CREATE TRIGGER member_admin_identity
    BEFORE INSERT OR UPDATE ON member 
    FOR EACH ROW 
    EXECUTE PROCEDURE member_admin_identity();
-- Trigger 3
-- A message's author must be a participant in the thread to which the message is being sent

DROP FUNCTION IF EXISTS message_sent CASCADE;
CREATE FUNCTION message_sent() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF NOT EXISTS (
        SELECT participant_id 
        FROM message_thread_participant 
        WHERE NEW.sender_id = message_thread_participant.participant_id AND NEW.thread_id = message_thread_participant.thread_id
    ) THEN
        RAISE EXCEPTION 'A message''s author must be a participant in the thread to which the message is being sent.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS message_sent on message CASCADE;
CREATE TRIGGER message_sent
    BEFORE INSERT ON message
    FOR EACH ROW
    EXECUTE PROCEDURE message_sent();
-- Trigger 4
-- A member cannot bid in their own auction (BR01)

DROP FUNCTION IF EXISTS self_bidding CASCADE;
CREATE FUNCTION self_bidding() RETURNS TRIGGER AS
$BODY$
BEGIN
    IF EXISTS (SELECT seller_id FROM auction WHERE NEW.bidder_id = auction.seller_id AND NEW.auction_id = auction.id ) THEN
        RAISE EXCEPTION 'A member cannot bid in their own auction.';
    END IF;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS self_bidding on bid CASCADE;
CREATE TRIGGER self_bidding
    BEFORE INSERT ON bid
    FOR EACH ROW 
    EXECUTE PROCEDURE self_bidding();
-- Trigger 6
-- Set the most recent bid reference on the auction

DROP FUNCTION IF EXISTS most_recent_bid CASCADE;
CREATE FUNCTION most_recent_bid() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE auction
        SET latest_bid = NEW.id
        WHERE auction.id = NEW.auction_id;

    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS most_recent_bid on bid CASCADE;
CREATE TRIGGER most_recent_bid
    AFTER INSERT ON bid
    FOR EACH ROW
    EXECUTE PROCEDURE most_recent_bid();
-- Trigger 7
-- Whenever a user rates another, its rating must be automatically updated

-- Review
DROP FUNCTION IF EXISTS update_rating_insert CASCADE;
CREATE FUNCTION update_rating_insert() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
        SET rating = rating + NEW.value
        WHERE member.id = NEW.ratee_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating_insert on rating CASCADE;
CREATE TRIGGER update_rating_insert
    AFTER INSERT ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating_insert();

DROP FUNCTION IF EXISTS update_rating_update CASCADE;
CREATE FUNCTION update_rating_update() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
        SET rating = rating - OLD.value + NEW.value
        WHERE member.id = NEW.ratee_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating_update on rating CASCADE;
CREATE TRIGGER update_rating_update
    AFTER UPDATE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating_update();


DROP FUNCTION IF EXISTS update_rating_delete CASCADE;
CREATE FUNCTION update_rating_delete() RETURNS TRIGGER AS
$BODY$
BEGIN
    UPDATE member
        SET rating = rating - OLD.value
        WHERE member.id = OLD.ratee_id;
    RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS update_rating_delete on rating CASCADE;
CREATE TRIGGER update_rating_delete
    AFTER DELETE ON rating
    FOR EACH ROW
    EXECUTE PROCEDURE update_rating_delete();
-- Trigger 9
-- When a new auction is created, a *Created Auction* notification is generated for each user that is following that auction's creator

DROP FUNCTION IF EXISTS created_auction_notification CASCADE;
CREATE FUNCTION created_auction_notification() RETURNS TRIGGER AS
$BODY$
DECLARE temprow RECORD;
DECLARE notif_id INTEGER;
BEGIN
	FOR temprow IN
        (SELECT follower_id 
		    FROM follow
                INNER JOIN auction ON follow.followed_id = auction.seller_id
		    WHERE follow.followed_id = NEW.seller_id)
    LOOP
		INSERT INTO notification (type, member_id)
			VALUES ('Created Auction', temprow.follower_id)
			RETURNING id INTO notif_id;

		INSERT INTO auction_notification (notification_id, auction_id)
		VALUES (notif_id, NEW.id);
    END LOOP;

	RETURN NEW;
END
$BODY$
LANGUAGE plpgsql;

DROP TRIGGER IF EXISTS created_auction_notification on auction CASCADE;
CREATE TRIGGER created_auction_notification
    AFTER INSERT ON auction
    FOR EACH ROW
    EXECUTE PROCEDURE created_auction_notification();
