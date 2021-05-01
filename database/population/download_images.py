import json

import sys
from image_processing import ImageProcessor

# Constants
root = 'database/population/'

populationUserInfoFilename = root + 'population_users.json'
populationAuctionInfoFilename = root + 'population_auctions.json'

# Config
download_users = False
start_users = 1
end_users = None

download_auctions = True
start_auctions = 1
end_auctions = None


if download_users:
    f = open(populationUserInfoFilename, 'r')
    data = json.load(f)

    for i in range(start_users, end_users if end_users != None else len(data) + 1):
        user = data[str(i)]
        if not ImageProcessor.profile_images(user['img_url'], i):
            print(f"[!] User <{i}> does not have images!", file=sys.stderr)


if download_auctions:
    f = open(populationAuctionInfoFilename, 'r')
    data = json.load(f)

    for i in range(start_auctions, end_auctions if end_auctions != None else len(data) + 1):
        auction = data[str(i)]
        if not ImageProcessor.auction_images(auction['thumbnail_url'], i, 'thumbnail'):
            print(f"[!] Auction <{i}> does not have a thumbnail!", file=sys.stderr)

        for img in auction['images']:
            if not ImageProcessor.auction_images(img['url'], i, img['image_id']):
                print(f"[!] Auction <{i}> does not have the image <{img['image_id']}>!", file=sys.stderr)
