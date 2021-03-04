<?php
function draw_auction_entry($current_bid, $personal_bid = null, $bookmarked = false)
{
?>

    <div class="row container auction-entry py-3">
        <!-- Product image -->
        <img class="col-3 img-thumbnail" src="https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg">

        <div class="col">
            <div class="col row">
                <div class="col">
                    <h4>
                        <a class="text-decoration-none link-dark" href="auction.php">Foo Fighters - Greatest Hits MP3</a>
                        <i class="bi bi-circle-fill align-middle text-success" style="font-size: 0.5em;"></i>
                    </h4>
                    <p class="text-muted">Created by <a class="text-decoration-none link-dark" href="user_profile.php">carlospereira</a></p>
                    
                    <!-- Bids -->
                    <div class="row">
                        <div class="col d-flex flex-column">
                            <span>Current bid</span>
                            <h4><?= $current_bid ?> &euro;</h4>
                        </div>

                        <?php
                        if ($personal_bid) {
                        ?>

                            <div class="col d-flex flex-column">
                                <span>Your bid</span>
                                <h4><?= $personal_bid ?> &euro;</h4>
                            </div>

                        <?php
                        }
                        ?>
                    </div>
                </div>

                <div class="col">
                    <p>Started on: 22 feb. 2021 23:59</h4>
                    <p>Ended on: 23 feb. 2021 23:59</h4>
                </div>
            </div>


        </div>

        <div class="col-1">
            <?php
            if (!$bookmarked) {
            ?>

                <i class="bi bi-bookmark-plus" style="font-size: 2em"></i>

            <?php
            } else {
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