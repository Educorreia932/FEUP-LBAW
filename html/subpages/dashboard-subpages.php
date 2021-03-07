<?php

include_once(__DIR__ . "/../components/auction_entry.php");
include_once(__DIR__ . "/../components/user_entry.php");


function dashboard_created_auctions() { ?>
    <div class="container-fluid">
        <h2 class="my-4">Created Auctions</h2>

        <div>
            <?php
                for ($i = 0; $i < 5; $i++) {
                    draw_auction_entry(6.66);

                    echo "<hr>";
                }
            ?>
        </div>
    </div>
<?php }

function dashboard_bidded_auctions() { ?>
    <div class="container-fluid">
        <h2 class="my-4">Bidded Auctions</h2>

        <div>
            <?php
                for ($i = 0; $i < 5; $i++) {
                    draw_auction_entry(6.66, 5.00);

                    echo "<hr>";
                }
            ?>
        </div>
    </div>
<?php }

function dashboard_bookmarked_auctions() { ?>
    <div class="container-fluid">
        <h2 class="my-4">Bookmarked Auctions</h2>

        <div>
            <?php
                for ($i = 0; $i < 5; $i++) {
                    draw_auction_entry(6.66, null, true);

                    echo "<hr>";
                }
            ?>
        </div>
    </div>
<?php }

function dashboard_followed() { ?>
    <div class="container-fluid">
        <h2 class="my-4">Followed</h2>

        <div class="container">
            <?php
                for ($i = 0; $i < 5; $i++) {
                    draw_user_entry();

                    echo "<hr>";
                }
            ?>
        </div>
    </div>
<?php } ?>