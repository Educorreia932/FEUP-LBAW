import random
import requests
import json
import bs4
from time import sleep

output_file = 'app_details.json'
all_apps_url = 'https://api.steampowered.com/ISteamApps/GetAppList/v0001/'

total_requests = 0

mandatory_list = [
    218620, # Payday 2
    367520, # Hollow Knight
    1030300, # Silksong
    504230, # Celeste
    1092840, # Celeste OST
    598190, # Hollow Knight OST
    916000, # Hollow Knight Gods & Nightmares OST
    257510, # The Talos Principle
    358470, # The Talos Principle: Road to Gehenna
    322020, # The Talos Principle OST
    219890, # Antichamber
    881100, # Noita
    1161410, # Noita OST
    736260, # Baba is you
    955710, # Baba is you OST
    524220, # NieR: Automata
    1113560, # NieR: Replicant
    1029210, # 30XX
    322110, # 20XX
    390710, # Acceleration of Suguri 2
    1145360, # Hades
    1206340, # Hades OST
    237930, # Transistor
    299240, # Transistor OST
    492820, # Acceleration of Suguri 2 OST (Accelerator)
    546560, # Half-Life: Alyx
    220, # Half-Life 2
    70, # Half-Life
    130, # Half-Life: Blue Shift
    380, # Half-Life 2: Episode One
    420, # Half-Life 2: Episode Two
    379720, # Doom
    782330, # Doom Eternal
    2280, # Ultimate Doom
]

def getAvailableApps():
    r = requests.get(all_apps_url)
    data = json.loads(r.text)
    data = data['applist']['apps']['app']
    return data

def getAppInfo(app):
    global total_requests
    total_requests += 1

    sleep(1)

    if total_requests > 50:
        print("Waiting 60 sec to not get blocked by Steam API ⌛")
        sleep(60)
        print("Restarting")
        total_requests = 0

    url = f'https://store.steampowered.com/api/appdetails?appids={app}&cc=pt&l=en'
    r = requests.get(url)
    data = json.loads(r.text)

    if data == None:
        raise Exception("Blocked from Steam API 😔")
    if not data[str(app)]['success']:
        print(f"Failed to retrieve app {app}")
        return None

    data = data[str(app)]['data']

    title = data['name']
    price = f"€{data['price_overview']['final'] / 100.0}" \
        if 'price_overview' in data else None

    # soup = bs4.BeautifulSoup(data['detailed_description'], 'html.parser')
    # description = soup.text

    short_description = data['short_description']

    header_image = data['header_image']

    appType = data['type']
    if appType == 'dlc':
        lowerDescription = short_description.lower()
        appType = 'music' if ('soundtrack' in lowerDescription or 'ost' in lowerDescription) else 'game'

    screenshots = []
    if 'screenshots' in data:
        screenshots = data['screenshots'][:5]

    print("------------------")
    print(title)
    print(appType)
    print("------------------")

    return {
        'id': app,
        'type': appType,
        'title': title,
        'price': price,
        'header_image': header_image,
        'description': short_description,
        'screenshots': screenshots
    }

def addRandomApps(all_apps, app_data, n_apps=5):
    try:
        i = 0
        while i < n_apps:
            app = all_apps[random.randint(0, len(all_apps))]
            if str(app['appid']) in app_data:
                continue
            print(f"{app['appid']} ~ {app['name']}")
            app_details = getAppInfo(app['appid'])
            if app_details != None:
                app_data[str(app_details['id'])] = app_details
                i += 1
    except Exception as e:
        print(e)
        return



# Initialize apps we want present
# app_data = dict()
# for app_id in mandatory_list:
#     app = getAppInfo(app_id)
#     app_data[str(app_id)] = app

# Load previous data
f = open(output_file, 'r', encoding="utf8")
app_data = json.load(f)
f.close()

prevApps = len(app_data)

# Add more available apps
all_apps = getAvailableApps()
addRandomApps(all_apps, app_data, 300)

# Output to JSON
f = open(output_file, 'w', encoding="utf8")
json.dump(app_data, f, separators=(',', ': '), indent='\t')
f.close()

print(f"Added {len(app_data) - prevApps} entries to {output_file}")
