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
    <script defer src="../js/search_results.js"></script>
    <script defer src="../js/bookmark.js"></script>
    <script defer src="../js/master_checkboxes.js"></script>

    <!-- Categories -->
    <div>
        <p class="text-secondary my-2">Category</p>

        <div class="master-checkbox-reverse">
            <?php
            filter_checkbox("All", "a", true, true);
            ?>
            
            <div class="row">
                <div class="col">
                    <?php
                    filter_checkbox("Games", "b");
                    filter_checkbox("E-Books", "c");
                    filter_checkbox("Music", "d");
                    ?>
                </div>

                <div class="col">
                    <?php
                    filter_checkbox("Software", "e");
                    filter_checkbox("Skins", "f");
                    filter_checkbox("Others", "f");
                    ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Auction Owner -->
    <div class="my-3" id="auction-owner-radios">
        <p class="text-secondary my-2">Auction Owner</p>

        <div class="form-check">
            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-any" checked>
            <label class="form-check-label" for="radio-owner-any">
                Any
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-followed">
            <label class="form-check-label" for="radio-owner-followed">
                Followed Users
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-user">
            <label class="form-check-label" for="radio-owner-user">
                Specific User
            </label>
        </div>
        <div class="input-group mb-3">
            <span class="input-group-text" id="radio-owner-user-at">@</span>
            <input type="text" id="radio-owner-user-input" class="form-control" placeholder="Username" aria-label="Username" aria-describedby="radio-owner-user-at" disabled>
        </div>
    </div>


    <!-- Auction timeframe -->
    <div class="my-3">
        <p class="text-secondary my-2">Auction timeframe</p>

        <?php
        filter_checkbox("Scheduled", "g");
        filter_checkbox("Open", "h", true);
        ?>
    </div>

    <!-- Current bid price range -->
    <div class="my-3">
        <label class="text-secondary" for="price-range">Current bid (€)</label>
        
        <div class="row">
            <div class="d-flex">
                <div id="price-range-slider" class="my-2 mx-4 w-100">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                <input type="text" class="form-control" id="input-number-left" aria-label="Amount (to the nearest dollar)">
            </div>

            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                <input type="text" class="form-control" id="input-number-right" aria-label="Amount (to the nearest dollar)">
            </div>
        </div>
    </div>
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
