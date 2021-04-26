from PIL import Image, ImageFilter
from io import BytesIO
import requests
import os

class ImageProcessor():
    pw_small = 40
    pw_medium = 200

    aw_card = 200
    aw_small = 300
    aw_medium = 600

    userRoot = 'public/images/users/'
    auctionRoot = 'public/images/auctions/'

    @staticmethod
    def getImage(url)->Image:
        r = requests.get(url)
        return Image.open(BytesIO(r.content))

    @staticmethod
    def resize(img: Image, width)->Image:
        wpercent = (width / float(img.size[0]))
        hsize = int((float(img.size[1]) * float(wpercent)))
        return img.resize((width, hsize), Image.ANTIALIAS)

    @staticmethod
    def crop_center(img: Image)->Image:
        s = min(img.size[0], img.size[1])
        left = (img.size[0] - s) / 2
        upper = (img.size[1] - s) / 2
        return img.crop(box=(left, upper, left + s, upper + s))

    @classmethod
    def profile_images(cls, url: str, id: int)->bool:
        try:
            os.makedirs(cls.userRoot, exist_ok=True)
            img = cls.getImage(url)
            img.save(f'{cls.userRoot}{id}_original.png')
            img_crop = cls.crop_center(img)
            img_small = cls.resize(img_crop, cls.pw_small)
            img_small.save(f'{cls.userRoot}{id}_small.png')
            img_medium = cls.resize(img_crop, cls.pw_medium)
            img_medium.save(f'{cls.userRoot}{id}_medium.png')
            return True
        except:
            if os.path.isfile(f'{cls.userRoot}{id}_original.png'):
                os.remove(f'{cls.userRoot}{id}_original.png')
            if os.path.isfile(f'{cls.userRoot}{id}_small.png'):
                os.remove(f'{cls.userRoot}{id}_small.png')
            if os.path.isfile(f'{cls.userRoot}{id}_medium.png'):
                os.remove(f'{cls.userRoot}{id}_medium.png')
            return False

    @classmethod
    def auction_images(cls, url: str, auction_id, id)->bool:
        try:
            os.makedirs(f'{cls.auctionRoot}{auction_id}', exist_ok=True)
            img = cls.getImage(url)
            img.save(f'{cls.auctionRoot}{auction_id}/{id}_original.png')
            img_card = cls.resize(cls.crop_center(img), cls.aw_card)
            img_card.save(f'{cls.auctionRoot}{auction_id}/{id}_card.png')
            img_small = cls.resize(img, cls.aw_small)
            img_small.save(f'{cls.auctionRoot}{auction_id}/{id}_small.png')
            img_medium = cls.resize(img, cls.aw_medium)
            img_medium.save(f'{cls.auctionRoot}{auction_id}/{id}_medium.png')
            return True
        except:
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_original.png'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_original.png')
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_card.png'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_card.png')
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_small.png'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_small.png')
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_medium.png'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_medium.png')
            return False


ImageProcessor.auction_images("https://cdn.akamai.steamstatic.com/steam/apps/594860/header.jpg?t=1491337373", "__a", "0")

