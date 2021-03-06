<?php
include_once(__DIR__ . "/../components/auction_entry.php");

function search_results_auctions_ordering() { ?>
    <li><a class="dropdown-item" href="#">Bid Price</a></li>
    <li><a class="dropdown-item" href="#">Remaining Time</a></li>
    <li><a class="dropdown-item" href="#">Creation Date</a></li>
    <li><a class="dropdown-item" href="#">Bidders</a></li>
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
    <div class="my-3">
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
        <label class="text-secondary" for="price-range">Current bid</label>
        
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
    <div>
        <?php
        for ($i = 0; $i < 5; $i++) {
            draw_auction_entry(6.04, 5.01);

            if ($i < 4)
                echo "<hr>";
        }
        ?>
    </div>
<?php } ?>
