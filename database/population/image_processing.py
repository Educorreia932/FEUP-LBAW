from PIL import Image, ImageFilter
from io import BytesIO
from os.path import exists, isdir
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
        if (exists(f'{cls.userRoot}{id}_original.png')):
            print(f'[-] User <id> already exists, skipping')
            return True

        try:
            os.makedirs(cls.userRoot, exist_ok=True)

            img = cls.getImage(url)
            img.save(f'{cls.userRoot}{id}_original.png')

            if img.mode in ("RGBA", "P"):
                img = img.convert("RGB")

            img_crop = cls.crop_center(img)
            img_small = cls.resize(img_crop, cls.pw_small)
            img_small.save(f'{cls.userRoot}{id}_small.jpg')
            img_medium = cls.resize(img_crop, cls.pw_medium)
            img_medium.save(f'{cls.userRoot}{id}_medium.jpg')
            return True
        except Exception as e:
            print(e)
            if os.path.isfile(f'{cls.userRoot}{id}_original.png'):
                os.remove(f'{cls.userRoot}{id}_original.png')
            if os.path.isfile(f'{cls.userRoot}{id}_small.jpg'):
                os.remove(f'{cls.userRoot}{id}_small.jpg')
            if os.path.isfile(f'{cls.userRoot}{id}_medium.jpg'):
                os.remove(f'{cls.userRoot}{id}_medium.jpg')
            return False


    @classmethod
    def auction_images(cls, url: str, auction_id, id)->bool:

        if (exists(f'{cls.auctionRoot}{auction_id}/{id}_original.png')):
            print(f'[-] Auction <{auction_id}> image <{id}> already exists, skipping')
            return True

        try:
            os.makedirs(f'{cls.auctionRoot}{auction_id}', exist_ok=True)

            img = cls.getImage(url)
            img.save(f'{cls.auctionRoot}{auction_id}/{id}_original.png')

            if img.mode in ("RGBA", "P"):
                igm = img.convert("RGB")

            img_card = cls.resize(cls.crop_center(img), cls.aw_card)
            img_card.save(f'{cls.auctionRoot}{auction_id}/{id}_card.jpg')
            img_small = cls.resize(img, cls.aw_small)
            img_small.save(f'{cls.auctionRoot}{auction_id}/{id}_small.jpg')
            img_medium = cls.resize(img, cls.aw_medium)
            img_medium.save(f'{cls.auctionRoot}{auction_id}/{id}_medium.jpg')
            return True
        except Exception as e:
            print(e)
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_original.png'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_original.png')
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_card.jpg'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_card.jpg')
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_small.jpg'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_small.jpg')
            if os.path.isfile(f'{cls.auctionRoot}{auction_id}/{id}_medium.jpg'):
                os.remove(f'{cls.auctionRoot}{auction_id}/{id}_medium.jpg')
            return False


# ImageProcessor.auction_images("https://cdn.akamai.steamstatic.com/steam/apps/594860/header.jpg?t=1491337373", "__a", "0")

# ImageProcessor.profile_images("https://static.jojowiki.com/images/thumb/2/23/latest/20191212204955/JonathanAv.png/120px-JonathanAv.png", 0)
