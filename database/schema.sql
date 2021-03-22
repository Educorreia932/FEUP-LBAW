-- Types

CREATE TYPE auction_category AS ENUM ( 'Games', 'Software', 'E-Books', 'Skins', 'Music', 'Others' );

CREATE TYPE auction_status AS ENUM ( 'Active', 'Closed', 'Scheduled', 'Canceled', 'Frozen', 'Terminated' );

CREATE TYPE auction_report_reason AS ENUM ( 'Fraudalent Auction', 'Improper product pictures', 'Improper auction title', 'Other' );

CREATE TYPE user_report_reason AS ENUM ( 'Fraud', 'Improper profile image', 'Improper username', 'Other' );

CREATE TYPE notification_type AS ENUM ( 'User Followed', 'Message Received', 'Created Auction', 'Auction Outbid', 'Bookmarked Auction' );

-- Tables

CREATE TABLE member (
	id 						SERIAL PRIMARY KEY,
	username 				TEXT NOT NULL UNIQUE,
	email					TEXT NOT NULL UNIQUE,
	"password"				TEXT NOT NULL,
	"name"					TEXT NOT NULL,
	bio						TEXT,
	joined					TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
	credit					MONEY NOT NULL CONSTRAINT credit_ck CHECK (credit >= 0::MONEY)
);

CREATE TABLE auction (
	id							SERIAL PRIMARY KEY,
	title						TEXT NOT NULL,
	description			    	TEXT NOT NULL,
	starting_bid				MONEY NOT NULL CONSTRAINT starting_bid_ck CHECK (starting_bid >= 0::MONEY),
	increment_fixed				MONEY CONSTRAINT increment_fixed_ck CHECK (increment_fixed IS NULL OR increment_fixed > 0::MONEY),
	increment_percent			REAL CONSTRAINT increment_percent_ck CHECK (increment_percent IS NULL OR (increment_percent > 0 AND increment_percent <= 0.5)),
	start_date					TIMESTAMP WITH TIME ZONE NOT NULL,
	end_date					TIMESTAMP WITH TIME ZONE NOT NULL,
	status						auction_status NOT NULL,
	category					auction_category NOT NULL,
	nsfw						BOOLEAN NOT NULL DEFAULT FALSE,	
	CONSTRAINT increment_xor 	CHECK ((increment_fixed IS NULL AND increment_percent IS NOT NULL) OR (increment_fixed IS NOT NULL AND increment_percent IS NULL)),
	CONSTRAINT dates_ck 		CHECK (end_date < start_date)
);

CREATE TABLE follow (
	id                         SERIAL PRIMARY KEY,       
	follower_id                INTEGER REFERENCES member(id) NOT NULL,
	followed_id                INTEGER REFERENCES member(id) NOT NULL,
	CONSTRAINT member_ck CHECK (follower_id != followed_id)
);

CREATE TABLE bid (
    id						SERIAL PRIMARY KEY,
    value					MONEY NOT NULL CONSTRAINT value CHECK (value >= 0::MONEY),
    "date"					TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
    auction_id				INTEGER REFERENCES auction(id) NOT NULL,
	bidder_id 				INTEGER REFERENCES member(id) NOT NULL
);

CREATE TABLE message_thread (
	id 				SERIAL PRIMARY KEY,
	topic			TEXT
);

CREATE TABLE message_thread_participant (
	thread_id			INTEGER REFERENCES message_thread(id) NOT NULL,
	participant_id		INTEGER REFERENCES member(id) NOT NULL,
	PRIMARY KEY (thread_id, participant_id)
);

CREATE TABLE "message" (
	id                     SERIAL PRIMARY KEY,
	body                   TEXT NOT NULL,
	thread_id	           INTEGER REFERENCES message_thread(id) NOT NULL,
	sender_id              INTEGER REFERENCES member(id) NOT NULL,
	"timestamp"            TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL
);

CREATE TABLE auction_report (
	id					    SERIAL PRIMARY KEY,
	reason                  auction_report_reason NOT NULL,
	description             TEXT,
	"timestamp"             TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
	reporter_id             INTEGER REFERENCES member(id) NOT NULL,
	reported_id     		INTEGER REFERENCES auction(id) NOT NULL
);

CREATE TABLE user_report (
	id					SERIAL PRIMARY KEY,
	reason				user_report_reason NOT NULL,
	description			TEXT,
	"timestamp"			TIMESTAMP WITH TIME ZONE DEFAULT now() NOT NULL,
	reporter_id			INTEGER REFERENCES member(id) NOT NULL,
	reported_id			INTEGER REFERENCES member(id) NOT NULL,
	CONSTRAINT same_user_ck CHECK (reporter_id != reported_id)
);

CREATE TABLE rating (
	id                   SERIAL PRIMARY KEY,
	value                INTEGER NOT NULL,
	ratee_id             INTEGER REFERENCES MEMBER(id) NOT NULL,
	rater_id             INTEGER REFERENCES MEMBER(id) NOT NULL,
	CONSTRAINT value_ck CHECK (value = -1 OR value = 1),
	CONSTRAINT member_ck CHECK (ratee_id != rater_id)
);

CREATE TABLE admin (
	id			SERIAL PRIMARY KEY,
	username	TEXT UNIQUE NOT NULL,
	password	TEXT NOT NULL
);

CREATE TABLE bookmarked_auction (
	auction_id       INTEGER REFERENCES auction(id) NOT NULL,
	member_id        INTEGER REFERENCES member(id) NOT NULL,
	PRIMARY KEY (auction_id, member_id)
);

CREATE TABLE notification (
	id              SERIAL PRIMARY KEY,
	type            notification_type NOT NULL,
	time            TIMESTAMP NOT NULL,
	read            BOOLEAN NOT NULL DEFAULT FALSE,
	member_id       INTEGER REFERENCES member(id)
);

CREATE TABLE auction_notification (
	notification_id 	INTEGER REFERENCES notification(id),
	auction_id 			INTEGER REFERENCES auction(id),
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
	id 					SERIAL PRIMARY KEY,
	auction_id			INTEGER REFERENCES auction(id) NOT NULL,
	url					TEXT NOT NULL
);
