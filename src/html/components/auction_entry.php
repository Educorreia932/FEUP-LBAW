<?php
function draw_auction_entry($current_bid, $personal_bid = null, $bookmarked = false)
{
?>

    <div class="row container auction-entry py-3 col-lg-10">
        <!-- Product image -->
        <img class="col-3 img-thumbnail" src="https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg">

        <div class="col">
            <div class="col row">
                <div class="col">
                    <h4>
                        <a href="auction.php">Foo Fighters - Greatest Hits MP3</a>
                        <i class="bi bi-circle-fill align-middle text-success" style="font-size: 0.5em;"></i>
                    </h4>
                    <p>Created by <a href="user_profile.php">carlospereira</a></p>
                </div>

                <div class="col">
                    <p>Started on: 22 feb. 2021 23:59</h4>
                </div>
            </div>

            <div class="row">
                <p class="col">
                    <span style="font-size: 1.6em;"><?= $current_bid ?>&euro;</span> Current bid
                </p>

                <?php
                if ($personal_bid) {
                ?>

                    <p class="col">
                        <span style="font-size: 1.6em;"><?= $personal_bid ?>&euro;</span> Your bid
                    </p>

                <?php
                }
                ?>
            </div>
        </div>

        <div class="col-1">
            <?php
                if (!$bookmarked) {
            ?>
                <i class="bi bi-bookmark-plus" style="font-size: 2em"></i>
            
            <?php
                }

                else {
            ?>

                <i class="bi bi-bookmark-check-fill" style="font-size: 2em"></i>

            <?php
                }
            ?>
        </div>
    </div>

<?php
}
?>