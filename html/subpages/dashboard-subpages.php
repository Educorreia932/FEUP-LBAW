<?php

include_once(__DIR__ . "/../components/breadcrumbs.php");
include_once(__DIR__ . "/../components/auction_entry.php");
include_once(__DIR__ . "/../components/user_entry.php");

function dashboard_breadcrumbs() {
    breadcrumbs(array("Home", "Me", "Dashboard"), array("home.php", "profile.php"));
}

function dashboard_created_auctions() { ?>
    <div class="container-fluid">
        <div class="my-4">
            <h2>Created Auctions</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>

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
        <div class="my-4">
            <h2>Bidded Auctions</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>

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
        <div class="my-4">
            <h2>Bookmarked Auctions</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>

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
        <div class="my-4">
            <h2>Followed</h2>
            <?php dashboard_breadcrumbs(); ?> 
        </div>        

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