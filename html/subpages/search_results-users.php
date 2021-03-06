<?php
include_once(__DIR__ . "/../components/auction_entry.php");
include_once(__DIR__ . "/../components/user_entry.php");

function search_results_users_ordering() { ?>
    <li><a class="dropdown-item" href="#">Rating</a></li>
    <li><a class="dropdown-item" href="#">Total Auctions</a></li>
    <li><a class="dropdown-item" href="#">Date Joined</a></li>
<?php }

function search_results_users_filters() { ?>
    <script defer src="../js/search_results_user.js"></script>
     <!-- Options -->
     <div>
        <p class="text-secondary my-2">Options</p>

        <div class="master-checkbox-reverse">
            
            <div class="row">
                <div class="col">
                    <?php
                    filter_checkbox("Has auctions", "b");
                    ?>
                </div>

            </div>
        </div>
    </div>

    
    <!-- Followed / All Users -->
    <div class="my-3">
        <div class="form-check">
            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-any" checked>
            <label class="form-check-label" for="radio-owner-any">
                All Users
            </label>
        </div>
        <div class="form-check">
            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-followed">
            <label class="form-check-label" for="radio-owner-followed">
                Followed Users
            </label>
        </div>
    </div>

    <!-- Current bid price range -->
    <div class="my-3">
        <label class="text-secondary" for="rating-range">User Rating</label>
        
        <div class="row">
            <div class="d-flex">
                <div id="rating-range-slider" class="my-2 mx-4 w-100">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                <input type="text" class="form-control" id="input-number-left" aria-label="User Rating">
            </div>

            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                <input type="text" class="form-control" id="input-number-right" aria-label="User Rating">
            </div>
        </div>
    </div>

    <div class="form-group mt-3">
        <p class="text-secondary my-2">Joined</p>
        <div class="input-group">
            <span class="input-group-text" style="padding-right: 15px;">From</span>
            <input type="date" id="startDate" class="form-control">
        </div>
        <div class="input-group mt-2">
            <span class="input-group-text" style="padding-right: 36px;">To</span>
            <input type="date" id="endDate" class="form-control">
        </div>
    </div>
<?php } 


function search_results_users_results() {?>
    <div>
        <?php
        for ($i = 0; $i < 5; $i++) {
            draw_user_entry();

            if ($i < 4)
                echo "<hr>";
        }
        ?>
    </div>
<?php } ?>
