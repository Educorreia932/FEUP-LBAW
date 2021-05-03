from __future__ import annotations

import typing
import os, re, os.path
import json
import random
import time
import string
import math
import bcrypt
import requests

from decorators import timer

# Constants
root = 'database/population/'
jojoFilename = root + 'jojo.json'
steamAppsFilename = root + 'app_details.json'
lusiadasFilename = root + 'lusiadas.txt'
populateFilename = root + 'population.sql'

populationUserInfoFilename = root + 'population_users.json'
populationAuctionInfoFilename = root + 'population_auctions.json'

# Config
uniqueSalts = True

# ----------------- DATES ------------------------

limit_date = "2021-4-13 11:59:59"

d_format = '%Y-%m-%d %H:%M:%S'

def random_date(start: str, end: str, prop: float, format:str=d_format) -> str:
    """Get a time at a proportion of a range of two formatted times.

    start and end should be strings specifying times formated in the
    given format (strftime-style), giving an interval [start, end].
    prop specifies how a proportion of the interval to be taken after
    start.  The returned time will be in the specified format.
    """

    stime = time.mktime(time.strptime(start, format))
    etime = time.mktime(time.strptime(end, format))

    ptime = stime + prop * (etime - stime)

    return time.strftime(format, time.localtime(ptime))

def random_user_date() -> str:
    return random_date("2018-1-1 0:0:0", limit_date, random.random())

def random_limit_date(user_date, limit_date=limit_date) -> str:
    return random_date(user_date, limit_date, random.random())

def sum_time(t: str, interval: int, format:str=d_format) -> str:
    stime = time.mktime(time.strptime(t, format))
    etime = stime + interval
    return time.strftime(format, time.localtime(etime))

def random_auction_closing_date(auction_start, format=d_format):
    r = random.randint(0, 2)
    intervals = {
        0: 3600, # hour
        1: 3600 * 24,
        2: 3600 * 24 * 7
    }
    max_intervals = {
        0: 23,
        1: 6,
        2: 8
    }
    return sum_time(auction_start, intervals[r] * random.randint(1, max_intervals[r]), format)

def cmp_time(t1: str, t2: str, format:str=d_format) -> int:
    time1 = time.mktime(time.strptime(t1, format))
    time2 = time.mktime(time.strptime(t2, format))

    if time1 < time2:
        return -1
    elif time1 > time2:
        return 1
    else:
        return 0

def max_date(t1: str, t2: str, format:str=d_format) -> str:
    return t1 if cmp_time(t1, t2, format) >= 0 else t2

def cmp_time_now(timeString: str, format:str=d_format) -> int:
    stime = time.mktime(time.strptime(timeString, format))
    etime = time.time()

    if stime < etime:
        return -1
    elif stime > etime:
        return 1
    else:
        return 0

def cmp_time_minute_before(timeString: str, format:str=d_format) -> bool:
    stime = time.mktime(time.strptime(timeString, format)) - 60
    return time.strftime(format, time.localtime(stime))

def format_date(date):
    return "TIMESTAMP WITH TIME ZONE '" + date + "+00'"


# ------------------ OTHERS -------------------
def lerp(v0, v1, t):
    return (1 - t) * v0 + t * v1

# -------------------- GEN --------------------
class Gen:

    def __init__(self, outFile:typing.IO, verbose:bool=False):
        self.outFile = outFile
        self.verbose = verbose
        self.users = dict()
        self.auctions = dict()

    def writeTag(self, tag):
        self.outFile.write('-' * 80 + '\n')
        self.outFile.write('--{:^76}--\n'.format(tag))
        self.outFile.write('-' * 80 + '\n')

    @timer
    def gen(self):

        self.writeTag("USERS")
        n = self.userGen()
        if self.verbose:
            print(f"Generated {n} users")

        self.outFile.write('\n\n\n\n')
        self.writeTag("FOLLOW")
        n = self.genFollows()
        if self.verbose:
            print(f"Generated {n} follow")

        self.outFile.write('\n\n\n\n')
        self.writeTag("AUCTIONS")
        n = self.genAuctions()
        if self.verbose:
            print(f"Generated {n} auctions")

        self.outFile.write('\n\n\n\n')
        self.writeTag("RATINGS")
        n = self.genRatings()
        if self.verbose:
            print(f"Generated {n} ratings")

        self.outFile.write('\n\n\n\n')
        self.writeTag("BOOKMARKS")
        n = self.genBookmarks()
        if self.verbose:
            print(f"Generated {n} bookmarks")

        self.outFile.write('\n\n\n\n')
        self.writeTag("Messages")
        n, n1 = self.genMessages()
        if self.verbose:
            print(f"Generated {n} message threads & {n1} messages")

        self.outFile.write('\n\n\n\n')
        self.writeTag("User Reports")
        n = self.genUserReports()
        if self.verbose:
            print(f"Generated {n} user reports")

        self.outFile.write('\n\n\n\n')
        self.writeTag("Auction Reports")
        n = self.genAuctionReports()
        if self.verbose:
            print(f"Generated {n} auction reports")

        self.outFile.write('\n\n\n\n')
        self.writeTag("Admins")
        n = self.genAdmins()
        if self.verbose:
            print(f"Generated {n} admins")

        usersFile = open(populationUserInfoFilename, "w")
        auctionsFile = open(populationAuctionInfoFilename, "w")

        json.dump(self.users, usersFile, separators=(',', ': '), indent='\t')
        json.dump(self.auctions, auctionsFile, separators=(',', ': '), indent='\t')



    def genAdmins(self):
        password_1 = 'mosco'
        passwordHash_1 = bcrypt.hashpw(bytes(password_1, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')
        password_2 = 'gacha'
        passwordHash_2 = bcrypt.hashpw(bytes(password_2, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')
        password_3 = 'saav'
        passwordHash_3 = bcrypt.hashpw(bytes(password_3, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')
        password_4 = 'gizzard'
        passwordHash_4 = bcrypt.hashpw(bytes(password_4, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')
        statement = f"""INSERT INTO admin (username, password) VALUES ('iargo', '{passwordHash_1}');\n""" + \
            f"""INSERT INTO admin (username, password) VALUES ('toilmo', '{passwordHash_2}');\n""" + \
            f"""INSERT INTO admin (username, password) VALUES ('oivo', '{passwordHash_3}');\n""" + \
            f"""INSERT INTO admin (username, password) VALUES ('skelo', '{passwordHash_4}');\n"""

        self.outFile.write(statement)
        self.outFile.write('\n')

        return 4

    def genMessages(self):
        f = open(lusiadasFilename, 'r', encoding='utf8')
        lusiadas = f.readlines()
        f.close()

        messageThreads = 1
        messages = 0

        for u1 in range(1, len(self.users) - 3):
            threads = random.sample(range(u1 + 1, len(self.users) + 1), random.randint(0, 2))
            if u1 in threads:  # Make sure the owner is not included
                threads.remove(u1)

            for u2 in threads:
                statement = f"""INSERT INTO message_thread (id) VALUES (DEFAULT);\n""" + \
                    f"""INSERT INTO message_thread_participant (thread_id, participant_id) VALUES ({messageThreads}, {u1});\n""" + \
                    f"""INSERT INTO message_thread_participant (thread_id, participant_id) VALUES ({messageThreads}, {u2});\n"""
                self.outFile.write(statement)

                timestamp = max_date(self.users[u1]['join_date'], self.users[u2]['join_date'])
                timestamp = sum_time(timestamp, random.randint(3600 * 24, 3600 * 24 * 60))
                for _ in range(0, random.randint(1, 4)):
                    statement = f"""INSERT INTO message (thread_id, sender_id, "timestamp", body)\n\t""" + \
                        f"""VALUES ({messageThreads}, {random.choice([u1, u2])}, {format_date(timestamp)}, '{random.choice(lusiadas).replace("'", "''")}');\n"""

                    self.outFile.write(statement)
                    timestamp = sum_time(timestamp, random.randint(60, 3600 * 8))
                    messages += 1

                self.outFile.write("\n")
                messageThreads += 1

        return messageThreads - 1, messages

    def genFollows(self):
        follow_id = 1
        for u in range(1, len(self.users) + 1):
            follow_list = random.sample(range(1, len(self.users) + 1), random.randint(0, 12))
            if u in follow_list:  # Make sure the owner is not included
                follow_list.remove(u)

            for f in follow_list:
                statement = f"""INSERT INTO follow (follower_id, followed_id) VALUES ({u}, {f});\n"""
                self.outFile.write(statement)
                follow_id += 1

            self.outFile.write("\n")
        return follow_id - 1


    def genBookmarks(self):
        bookmark_id = 1
        for u in range(1, len(self.users) + 1):
            bookmark_list = random.sample(range(1, len(self.auctions) + 1), random.randint(6, 18))

            for b in bookmark_list:
                statement = f"""INSERT INTO bookmarked_auction (member_id, auction_id) VALUES ({u}, {b});\n"""
                self.outFile.write(statement)
                bookmark_id += 1

            self.outFile.write("\n")
        return bookmark_id - 1


    def add_rating(self, u:int, r:int, isPositive:bool):
        statement = f"""INSERT INTO rating (ratee_id, rater_id, value) VALUES ({u}, {r}, {1 if isPositive else -1});\n"""
        self.outFile.write(statement)

    def genRatings(self):
        ratings = 0
        for a in self.auctions.values():
            if a['winner'] == None:
                continue

            if random.random() < 0.3:
                self.add_rating(a['seller'], a['winner'], bool(random.randint(0, 1)))
                ratings += 1
            if random.random() < 0.3:
                self.add_rating(a['winner'], a['seller'], bool(random.randint(0, 1)))
                ratings += 1
        return ratings


    def genAuctionReports(self):
        for auction_id in self.fakeAuctions:
            seller_id = self.auctions[auction_id]['seller']
            reporter = None
            while reporter == None or reporter == seller_id:
                reporter = random.randrange(1, len(self.users) + 1)

            timestamp = max_date(max_date(self.auctions[auction_id]['start'], self.users[seller_id]['join_date']), self.users[reporter]['join_date'])
            timestamp = sum_time(timestamp, random.randint(200, 1400))

            statement = f"""INSERT INTO auction_report (reason, description, "timestamp", reporter_id, reported_id)\n\t""" + \
                f"""VALUES ('Fraudalent Auction', 'Attempt to sell product not released yet', {format_date(timestamp)}, {reporter}, {auction_id});\n"""

            self.outFile.write(statement)

        self.outFile.write("\n")

        return len(self.fakeAuctions)

    def genUserReports(self):
        n_reports = random.randint(2, 8)
        reasons = ['Fraud', 'Improper profile image', 'Improper username', 'Other']
        descriptions = ['Did not send product after auction ended', 'NSFW image', 'Offensive username', 'Is just ugly']
        for _ in range(0, n_reports):
            u1, u2 = random.sample(range(1, len(self.users) + 1), 2)
            report_type = random.randint(0, 3)
            timestamp = max_date(self.users[u1]['join_date'], self.users[u2]['join_date'])
            timestamp = sum_time(timestamp, random.randint(3600, 3600 * 24 * 8))
            statement = f"""INSERT INTO user_report (reason, description, "timestamp", reporter_id, reported_id)\n""" + \
                f"""VALUES ('{reasons[report_type]}', '{descriptions[report_type]}', {format_date(timestamp)}, {u1}, {u2});\n"""

            self.outFile.write(statement)

        self.outFile.write("\n")
        return n_reports


    def generate_bids(self, auction:dict):
        # Select pool of possible bidders
        bidders = random.sample(range(1, len(self.users) + 1), random.randint(2, 6) + 1)
        if auction['seller'] in bidders:  # Make sure the owner is not included
            bidders.remove(auction['seller'])

        last_bidder = None
        last_bid = auction['bid']

        bid_t = sorted([random.random() for _ in range(random.randint(0, 20))])

        for t in bid_t:
            # Prevent repeated bidders
            cur_bidder = None
            while cur_bidder == None or cur_bidder == last_bidder:
                cur_bidder = random.choice(bidders)
            last_bidder = cur_bidder

            next_bid = None
            if auction['fixed_increment'] != None:
                next_bid = last_bid + auction['fixed_increment']
            else:
                next_bid = math.ceil(last_bid * (100 + auction['percent_increment']) / 100)

            if random.random() > 0.1:
                next_bid += random.randint(1, 100)

            date = random_date(auction['start'], auction['end'], t)

            yield {'bidder': cur_bidder, 'value': next_bid, 'timestamp': date}
            last_bid = next_bid


    def genAuctions(self):

        self.fakeAuctions = set()
        self.reportableAuctions = set()

        f = open(steamAppsFilename, 'r')
        items = json.load(f)
        f.close()

        auction_id = 1
        image_id = 1
        bid_id = 1
        for item in items.values():

            total_item_auctions = 1 if random.random() < 0.9 else random.randint(2, 6)

            for _ in range(total_item_auctions):
                title = item['title'].replace("'", "''")
                description = item['description'].replace("'", "''")

                nsfw = 'FALSE'
                if 'hentai' in title.lower() or 'hentai' in description.lower() or 'nudity' in title.lower() or 'nudity' in description.lower() or 'Bikes and Girls' == item['title']:
                    nsfw = 'TRUE'

                if 'hitler' in title.lower() or 'hitler' in description.lower() or 'isis' in title.lower() or 'isis' in description.lower():
                    self.reportableAuctions.add(auction_id)

                price, starting_bid = None, None
                if item['price'] == None:
                    price = random.random() * 30
                    self.fakeAuctions.add(auction_id)
                else:
                    price = math.ceil(float(item['price'][1:]) * 100)

                starting_bid = math.ceil(price / (random.random() * 4.0 + 2.0))


                fixed_increment = None
                fixed_increment_str = 'NULL'
                percent_increment = None
                percent_increment_str = 'NULL'
                if random.random() < 0.75:
                    # Fixed increment
                    fixed_increment = random.randint(1, 200)
                    fixed_increment_str = str(fixed_increment)
                else:
                    # Percent increment
                    percent_increment = random.randint(1, 50)
                    percent_increment_str = str(percent_increment)

                user = self.users[random.randrange(1, len(self.users) + 1)]
                start_date = random_limit_date(user['join_date'])
                end_date = random_auction_closing_date(start_date)

                # TODO: Add chance of 'Canceled', 'Frozen', 'Terminated' auctions
                status = None
                if cmp_time_now(start_date) < 0:
                    status = 'Scheduled'
                else:
                    status = {
                        -1: 'Closed',
                        0: 'Active',
                        1: 'Active',
                    }[cmp_time_now(end_date)]

                category = None
                if item['type'] == 'game':
                    category = "Games"
                elif item['type'] == 'music':
                    category = "Music"
                elif item['type'] == 'episode':
                    category = "Series & Movies"
                else:
                    category = "Others"

                statement = f"""INSERT INTO auction (title, description, starting_bid, increment_fixed, increment_percent, start_date, end_date, status, category, nsfw, seller_id)\n\t""" + \
                    f"""VALUES ('{title}', '{description}', {starting_bid}, {fixed_increment_str}, {percent_increment_str}, {format_date(start_date)}, {format_date(end_date)}, '{status}', '{category}', {nsfw}, {user['id']});\n"""

                self.outFile.write(statement)

                rand_n_images = min(len(item['screenshots']), random.randint(0, 3))
                auction_imgs = []

                for stuff in random.sample(item['screenshots'], rand_n_images):
                    statement = f"""INSERT INTO auction_image (auction_id) VALUES ({auction_id});\n"""
                    self.outFile.write(statement)
                    auction_imgs.append({'image_id': image_id, 'url': stuff['path_full']})
                    image_id += 1

                self.auctions[auction_id] = {
                    'id': auction_id,
                    'bid': starting_bid,
                    'price': price,
                    'fixed_increment': fixed_increment,
                    'percent_increment': percent_increment,
                    'start': start_date,
                    'end': end_date,
                    'seller': user['id'],
                    'thumbnail_url': item['header_image'],
                    'images': auction_imgs,
                }

                last_bidder = None
                for bid in self.generate_bids(self.auctions[auction_id]):
                    statement = f"""INSERT INTO bid (value, "date", auction_id, bidder_id) """ + \
                        f"""VALUES({bid['value']}, {format_date(bid['timestamp'])}, {auction_id}, {bid['bidder']});\n"""
                    self.outFile.write(statement)
                    last_bidder = bid['bidder']
                    bid_id += 1

                self.auctions[auction_id]['winner'] = last_bidder
                self.outFile.write("\n")

                auction_id += 1
        return len(self.auctions)


    def userGen(self):
        f = open(jojoFilename, 'r')
        characters = json.load(f)
        f.close()

        password = 'zawarudo'

        passwordHash = None
        if not uniqueSalts:
            passwordHash = bcrypt.hashpw(bytes(password, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')


        user_id = 1
        for character in characters:

            if character['bio'].startswith('This is a list of minor characters') or character['bio'].startswith('This is a list of unnamed characters'):
                continue

            if uniqueSalts:
                passwordHash = bcrypt.hashpw(bytes(password, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')

            username = character['anchor'].replace("'", "''").replace("%27s", "")

            if character['anchor'] in (u['username'] for u in self.users.values()):
                continue

            name = character['title'].replace("'", "''")
            bio = character['bio'].replace("'", "''")
            r = random.random()
            credit_value = random.randint(0, 10000) if r <= 0.80 else random.randint(10000, 40000) if r <= 0.85 else 0

            joined_date = random_user_date()

            data_consent = "TRUE" if random.random() > 0.2 else "FALSE"
            notifications = "TRUE" if random.random() > 0.2 else "FALSE"
            outbid_notifications = "TRUE" if random.random() > 0.2 else "FALSE"
            start_auction_notifications = "TRUE" if random.random() > 0.2 else "FALSE"
            followed_user_activity = "TRUE" if random.random() > 0.2 else "FALSE"

            insertStatement = f"""INSERT INTO member (username, email, password, name, bio, joined, credit, data_consent, notifications, outbid_notifications, start_auction_notifications, followed_user_activity)\n\t""" + \
                f"""VALUES ('{username}', '{username}@jojo.com', '{passwordHash}', '{name}', '{bio}', {format_date(joined_date)}, {credit_value}, {data_consent}, {notifications}, {outbid_notifications}, {start_auction_notifications}, {followed_user_activity});\n"""

            self.outFile.write(insertStatement)

            self.users[user_id] = {
                'id': user_id,
                'username': username,
                'password': password,
                'join_date': joined_date,
                'img_url': character['src']
            }

            user_id += 1

        return len(self.users)


f = open(populateFilename, 'w', encoding="utf-8")
g = Gen(f, verbose=True)
g.gen()
f.close()
