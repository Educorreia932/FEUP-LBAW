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
                // $title, $owner, $img, $start, $end, $current_bid, $personal_bid = null, $bookmarked = false
                draw_auction_entry("The Talos Principle STEAM Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/615072-the-talos-principle-nintendo-switch-front-cover.jpg",
                    "3 mar 2021", "4 mar 2021", "17.80", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("NieR: Automata STEAM Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/414543-nier-automata-playstation-4-front-cover.jpg",
                    "21 feb mar 2021", "28 feb 2021", "25.48", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("JoJo Eyes of Heaven PS4 Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/382051-jojo-s-bizarre-adventure-eyes-of-heaven-playstation-4-front-cover.png",
                    "3 mar 2021", "4 mar 2021", "18.02", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("Stone Free - Jimi Hendrix", "Foo Fighters", "https://cdn.discordapp.com/attachments/808268891091501067/820312137838755870/iu.png",
                    "4 mar 2021", "8 mar 2021", "102.23", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("Foo Fighters - Greatest Hits MP3", "Foo Fighters", "https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg",
                    "6 apr 2021", "9 apr 2021", "21.73", $personal_bid = null, $bookmarked = false);
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
                // $title, $owner, $img, $start, $end, $current_bid, $personal_bid = null, $bookmarked = false
                draw_auction_entry("The Talos Principle STEAM Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/615072-the-talos-principle-nintendo-switch-front-cover.jpg",
                    "3 mar 2021", "4 mar 2021", "17.80", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("NieR: Automata STEAM Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/414543-nier-automata-playstation-4-front-cover.jpg",
                    "21 feb mar 2021", "28 feb 2021", "25.48", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("JoJo Eyes of Heaven PS4 Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/382051-jojo-s-bizarre-adventure-eyes-of-heaven-playstation-4-front-cover.png",
                    "3 mar 2021", "4 mar 2021", "18.02", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("Stone Free - Jimi Hendrix", "Foo Fighters", "https://cdn.discordapp.com/attachments/808268891091501067/820312137838755870/iu.png",
                    "4 mar 2021", "8 mar 2021", "102.23", $personal_bid = null, $bookmarked = false);
                echo "<hr>";
                draw_auction_entry("Foo Fighters - Greatest Hits MP3", "Foo Fighters", "https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg",
                    "6 apr 2021", "9 apr 2021", "21.73", $personal_bid = null, $bookmarked = false);
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
                // $title, $owner, $img, $start, $end, $current_bid, $personal_bid = null, $bookmarked = false
                draw_auction_entry("The Talos Principle STEAM Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/615072-the-talos-principle-nintendo-switch-front-cover.jpg",
                    "3 mar 2021", "4 mar 2021", "17.80", $personal_bid = null, $bookmarked = true);
                echo "<hr>";
                draw_auction_entry("NieR: Automata STEAM Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/414543-nier-automata-playstation-4-front-cover.jpg",
                    "21 feb mar 2021", "28 feb 2021", "25.48", $personal_bid = null, $bookmarked = true);
                echo "<hr>";
                draw_auction_entry("JoJo Eyes of Heaven PS4 Key", "Foo Fighters", "https://www.mobygames.com/images/covers/l/382051-jojo-s-bizarre-adventure-eyes-of-heaven-playstation-4-front-cover.png",
                    "3 mar 2021", "4 mar 2021", "18.02", $personal_bid = null, $bookmarked = true);
                echo "<hr>";
                draw_auction_entry("Stone Free - Jimi Hendrix", "Foo Fighters", "https://cdn.discordapp.com/attachments/808268891091501067/820312137838755870/iu.png",
                    "4 mar 2021", "8 mar 2021", "102.23", $personal_bid = null, $bookmarked = true);
                echo "<hr>";
                draw_auction_entry("Foo Fighters - Greatest Hits MP3", "Foo Fighters", "https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg",
                    "6 apr 2021", "9 apr 2021", "21.73", $personal_bid = null, $bookmarked = true);
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