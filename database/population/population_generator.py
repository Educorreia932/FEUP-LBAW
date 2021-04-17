from __future__ import annotations

import json
import random
import time
import string
import bcrypt

# Constants
jojoFilename = 'jojo.json'
steamAppsFilename = 'app_details.json'
populateFilename = 'out/populate.sql'

max_date = "2021-4-13 11:59:59"

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
    return random_date("2018-1-1 0:0:0", max_date, random.random())

def random_auction_date(user_date, max_date=max_date) -> str:
    return random_date(user_date, max_date, random.random())

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
    stime = time.mktime(time.strptime(auction_start, format))
    etime = stime + (intervals[r] * random.randint(1, max_intervals[r]))

    return time.strftime(format, time.localtime(etime))

def cmp_time_now(timeString: str, format:str=d_format) -> str:
    stime = time.mktime(time.strptime(timeString, format))
    etime = time.time()

    if stime < etime:
        return -1
    elif stime > etime:
        return 1
    else:
        return 0

def format_date(date):
    return "TIMESTAMP WITH TIME ZONE '" + date + "+00'"


class Gen:

    def __init__(self, outFile:typing.IO, verbose:bool=False):
        self.outFile = outFile
        self.verbose = verbose
        self.users = dict()
        self.auctions = dict()

    def writeTag(self, tag):
        self.outFile.write('------------------------------\n')
        self.outFile.write(f'--         {tag}\n')
        self.outFile.write('------------------------------\n')

    def gen(self):
        self.writeTag("USERS")
        self.userGen()
        if self.verbose:
            print(f"Generated {len(self.users)} users")
        # self.genUserReports()

        self.outFile.write('\n\n\n\n')
        self.writeTag("AUCTIONS")
        self.genAuctions()
        if self.verbose:
            print(f"Generated {len(self.auctions)} auctions")
    

    def genUserReports(self):
        
        return


    def genAuctions(self):

        self.fakeAuctions = set()
        self.reportableAuctions = set()

        f = open(steamAppsFilename, 'r')
        items = json.load(f)
        f.close()

        auction_id = 0
        image_id = 0
        for item in items.values():
            title = item['title'].replace("'", "''")
            description = item['description'].replace("'", "''")

            nsfw = 'FALSE'
            if 'hentai' in title.lower() or 'hentai' in description.lower() or 'nudity' in title.lower() or 'nudity' in description.lower():
                nsfw = 'TRUE'
            
            if 'hitler' in title.lower() or 'hitler' in description.lower() or 'isis' in title.lower() or 'isis' in description.lower():
                self.reportableAuctions.add(auction_id)

            price, starting_bid = None, None
            if item['price'] == None:
                price = random.random() * 30
                self.fakeAuctions.add(auction_id)
            else:
                price = float(item['price'][1:])

            starting_bid = price / (random.random() * 4 + 1)


            fixed_increment = None
            fixed_increment_str = 'NULL'
            percent_increment = None
            percent_increment_str = 'NULL'
            if random.random() < 0.75:
                # Fixed increment
                fixed_increment = random.random() * 2.0
                fixed_increment_str = "{:.2f}".format(fixed_increment) + "::money"
            else:
                # Percent increment
                percent_increment = max(0.01, random.random() * 0.5)
                percent_increment_str = "'{:.2f}'".format(percent_increment)

            user = self.users[random.randrange(0, len(self.users))]
            start_date = random_auction_date(user['join_date'])
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

            statement = f"""INSERT INTO auction (id, title, description, starting_bid, increment_fixed, increment_percent, start_date, end_date, status, category, nsfw, seller_id)
    VALUES ({auction_id}, '{title}', '{description}', {starting_bid}::money, {fixed_increment_str}, {percent_increment_str}, {format_date(start_date)}, {format_date(end_date)}, '{status}', '{category}', {nsfw}, {user['id']});\n"""

            self.outFile.write(statement)

            self.auctions[auction_id] = {'id': auction_id, 'bid': starting_bid, 'price': price, 'fixed_increment': fixed_increment, 'percent_increment': percent_increment, 'start': start_date, 'end': end_date, 'seller': user['id']}

            for _ in item['screenshots'][:random.randint(0, 4)]:
                # TODO: Save images to disk
                statement = f"""INSERT INTO auction_image (id, auction_id) VALUES ({image_id}, {auction_id});\n"""
                self.outFile.write(statement)
                image_id += 1

            self.outFile.write("\n")

            auction_id += 1
        return
    

    def genAuctionReports(self):

        return


    def userGen(self):
        f = open(jojoFilename, 'r')
        characters = json.load(f)
        f.close()

        password = 'zawarudo'
        passwordHash = bcrypt.hashpw(bytes(password, 'utf-8'), bcrypt.gensalt()).decode('UTF-8')

        i = 0
        for character in characters:
            username = character['anchor'].replace("'", "''").replace("%27s", "")

            if character['anchor'] in (u['username'] for u in self.users.values()):
                continue

            name = character['title'].replace("'", "''")
            bio = character['bio'].replace("'", "''")
            credit_value = (random.random() * 400.0) if random.random() <= 0.85 else 0.0
            credit = "{:.2f}".format(credit_value)

            joined_date = random_user_date()

            profile_picture = character['src'].replace("'", "''")

            data_consent = "TRUE" if random.random() > 0.2 else "FALSE"

            insertStatement = f"""INSERT INTO member (id, username, email, password, name, bio, joined, credit, profile_picture, data_consent)
            VALUES ({i}, '{username}', '{username}@jojo.com', '{passwordHash}', '{name}', '{bio}', {format_date(joined_date)}, {credit}::money, '{profile_picture}', {data_consent});\n"""

            self.outFile.write(insertStatement)

            self.users[i] = {'id': i, 'username': username, 'password': password, 'join_date': joined_date}
        
            i += 1



def main():
    f = open(populateFilename, 'w', encoding="utf-8")
    g = Gen(f, verbose=True)
    g.gen()
    f.close()


main()