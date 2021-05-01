<?php
include_once(__DIR__ . "/../components/auction_entry.php");

function search_results_auctions_ordering() { ?>
    <li><a class="dropdown-item" href="#">Bid Price</a></li>
    <li><a class="dropdown-item" href="#">Remaining Time</a></li>
    <li><a class="dropdown-item" href="#">Creation Date</a></li>
    <li><a class="dropdown-item" href="#">Bidders</a></li>
    <li><a class="dropdown-item" href="#">Popularity</a></li>
<?php }

function search_results_auctions_filters() { ?>
    
<?php } 


function search_results_auctions_results() {?>
    
    <p>Results for: <u>Fighters</u> (5)</p>

    <div>
        <?php draw_auction_entry("Foo Fighters - Greatest Hits MP3", "ffighters", "https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg",
                "13 mar 2021 12:00", "27 mar 2021 12:00", 125.3, 123.59, true); ?>
        <hr>
        <?php draw_auction_entry("Stream Fighters - STEAM KEY", "carlospereira", "https://cdn.akamai.steamstatic.com/steam/apps/1177810/header.jpg?t=1578487829",
                "10 mar 2021 17:30", "28 mar 2021 23:59", 0.83, 0.0, false); ?>
        <hr>
        <?php draw_auction_entry("Fighters Legacy - STEAM KEY", "ppenguin", "https://cdn.akamai.steamstatic.com/steam/apps/1024630/header.jpg?t=1584181828",
                "12 feb 2021 12:00", "20 mar 2021 14:00", 10.03, 0.0, false); ?>
        <hr>
        <?php draw_auction_entry("Freedom Fighters - STEAM KEY", "carlospereira", "https://cdn.akamai.steamstatic.com/steam/apps/1347780/header.jpg?t=1600704099",
                "13 mar 2021 12:00", "27 mar 2021 12:00", 3.54, 0.0, false); ?>
        <hr>
        <?php draw_auction_entry("Stone Free - Jim Hendrix", "ffighters", "https://cdn.discordapp.com/attachments/808268891091501067/820312137838755870/iu.png",
                "22 feb 2021 12:00", "15 mar 2021 23:59", 356.32, 236.43, true); ?>
    </div>
<?php } ?>
