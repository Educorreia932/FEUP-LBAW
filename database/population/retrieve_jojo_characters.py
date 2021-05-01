from html.parser import HTMLParser
import json

import requests
import bs4

def getBio(user):
    r = requests.get("https://jojowiki.com/" + user)
    soup = bs4.BeautifulSoup(r.text, 'html.parser')
    bio = ""
    for p in soup.select("div#mw-content-text.mw-content-ltr > div.mw-parser-output > p:not(.mw-empty-elt)"):
        # print("__" + p.text + "__")
        if (p.text != "") and (not p.text.startswith("See:")):
            return p.text[0:-1]
    return None

class MyHTMLParser(HTMLParser):

    blacklist = [
        "https://static.jojowiki.com/images/b/b1/latest/20200102223143/NoPicAv.png",
        "https://static.jojowiki.com/images/0/0e/latest/20191015213921/EditTab.png",
        "https://static.jojowiki.com/images/5/54/latest/20191214173021/Hitler_Av.png",
        "https://static.jojowiki.com/images/6/6f/latest/20210205234240/Yarpline_boy_manga_Av.png",
        "https://static.jojowiki.com/images/thumb/9/94/latest/20191212205924/BabyLisaLisaAv.png/120px-BabyLisaLisaAv.png",
    ]
    lastPic = "https://static.jojowiki.com/images/e/e1/latest/20200226033101/GucciInterpreterAv.jpg"

    def __init__(self, *args, **kwargs):
        super().__init__(*args, **kwargs)
        self.ignoreFlag = False
        self.pics = []
        self.lastAnchorHref = None        
        self.lastAnchorTitle = None        

    def handle_starttag(self, tag, attrs):
        if (self.ignoreFlag):
            return
        if (tag == "a"):
            for (atr, val) in attrs:
                if atr == "href":
                    self.lastAnchorHref = val
                elif atr == "title":
                    self.lastAnchorTitle = val
        elif (tag == "img"):
            src = None
            alt = None
            for (atr, val) in attrs:
                if atr == "src":
                    if ".gif" in val or val in self.blacklist:
                        return
                    src = val
                    if src == self.lastPic:
                        self.ignoreFlag = True
                        return
                elif atr == "alt":
                    alt = val.replace(".png", "").replace(".jpg", "")

            if not self.lastAnchorHref.startswith("/File"):
                bio = getBio(self.lastAnchorHref[1:])
                if bio != None:
                    self.pics.append({"src": src, "alt": alt, "anchor": self.lastAnchorHref[1:], "title": self.lastAnchorTitle, "bio": bio})
                    # print(self.lastAnchorTitle)
                    # print(bio)

    def handle_endtag(self, tag):
        pass

    def handle_data(self, data):
        pass

    def dump(self, s):
        outfile = open(s, mode="w", encoding="utf8")
        json.dump(self.pics, outfile, separators=(',', ': '), indent='\t')
        outfile.close()

file = open('jojo.html',mode='r', encoding="utf8") 
# read all lines at once
jojo_html = file.read()

parser = MyHTMLParser()
parser.feed(jojo_html)
parser.dump('jojo.json')


# print(getBio("Joseph_Joestar"))
# print(getBio("Wang_Chan"))
# print(getBio("Jonathan_Joestar"))