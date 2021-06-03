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

CREATE TYPE auction_status AS ENUM ( 'Active', 'Terminated' );

CREATE TYPE auction_report_reason AS ENUM ( 'Fraudalent Auction', 'Improper product pictures', 'Improper auction title', 'Other' );

CREATE TYPE user_report_reason AS ENUM ( 'Fraud', 'Improper profile image', 'Improper username', 'Other' );

CREATE TYPE notification_type AS ENUM ( 'User Followed', 'Message Received', 'Created Auction', 'Auction Outbid', 'Bookmarked Auction' );

-- Tables

CREATE TABLE member (
    id                                  SERIAL PRIMARY KEY,
    username                            TEXT UNIQUE,
    email                               TEXT UNIQUE,
    password                            TEXT,
    remember_token                      TEXT,
    name                                TEXT,
    bio                                 TEXT,
    phone_number                        TEXT,
    joined                              TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    credit                              INTEGER NOT NULL DEFAULT 0 CONSTRAINT credit_ck CHECK (credit >= 0),
    rating                              INTEGER DEFAULT 0 NOT NULL,
    nsfw_consent                        BOOLEAN DEFAULT FALSE NOT NULL,
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
    starting_bid                    INTEGER NOT NULL CONSTRAINT starting_bid_ck CHECK (starting_bid > 0),
    increment_fixed                 INTEGER CONSTRAINT increment_fixed_ck CHECK (increment_fixed IS NULL OR increment_fixed > 0),
    increment_percent               INTEGER CONSTRAINT increment_percent_ck CHECK (increment_percent IS NULL OR (increment_percent > 0 AND increment_percent <= 50)),
    start_date                      TIMESTAMP WITH TIME ZONE NOT NULL,
    end_date                        TIMESTAMP WITH TIME ZONE NOT NULL,
    status                          auction_status NOT NULL,
    category                        auction_category NOT NULL,
    nsfw                            BOOLEAN NOT NULL DEFAULT FALSE,
    seller_id                       INTEGER REFERENCES member(id) NOT NULL,
    latest_bid                      INTEGER DEFAULT NULL,
    next_bid                        INTEGER DEFAULT 1 NOT NULL CONSTRAINT next_bid_ck CHECK (next_bid > 0),
    ts_search                       TSVECTOR DEFAULT NULL,
    CONSTRAINT increment_xor_ck     CHECK ((increment_fixed IS NULL AND increment_percent IS NOT NULL) OR (increment_fixed IS NOT NULL AND increment_percent IS NULL)),
    CONSTRAINT dates_ck             CHECK (end_date > start_date)
);

CREATE TABLE bid (
    id                      SERIAL PRIMARY KEY,
    value                   INTEGER NOT NULL CONSTRAINT value CHECK (value > 0),
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
    id                      SERIAL PRIMARY KEY,
    topic                   TEXT DEFAULT 'Thread Topic' NOT NULL,
    created                 TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    latest_message          INTEGER DEFAULT NULL
);

CREATE TABLE message (
    id                     SERIAL PRIMARY KEY,
    body                   TEXT NOT NULL,
    thread_id              INTEGER REFERENCES message_thread(id) NOT NULL,
    sender_id              INTEGER REFERENCES member(id) NOT NULL,
    "timestamp"            TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    ts_search              TSVECTOR DEFAULT NULL
);

ALTER TABLE message_thread ADD CONSTRAINT message_foreign_key FOREIGN KEY(latest_message) REFERENCES message(id);

CREATE TABLE message_thread_participant (
    thread_id           INTEGER REFERENCES message_thread(id) NOT NULL,
    participant_id      INTEGER REFERENCES member(id) NOT NULL,
    PRIMARY KEY (thread_id, participant_id)
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
    id                         SERIAL PRIMARY KEY,
    notification_id            INTEGER UNIQUE REFERENCES notification(id),
    notif_auction_id           INTEGER REFERENCES auction(id)
);

CREATE TABLE user_notification (
    id                         SERIAL PRIMARY KEY,
    notification_id            INTEGER UNIQUE REFERENCES notification(id),
    notif_member_id            INTEGER REFERENCES member(id)
);

CREATE TABLE message_notification (
    id                         SERIAL PRIMARY KEY,
    notification_id            INTEGER UNIQUE REFERENCES notification(id),
    notif_message_id           INTEGER REFERENCES message(id)
);

CREATE TABLE auction_image (
    id                    SERIAL PRIMARY KEY,
    auction_id            INTEGER REFERENCES auction(id) NOT NULL
);

