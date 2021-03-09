<?php
function draw_auction_entry($current_bid, $personal_bid = null, $bookmarked = false)
{
?>

    <div class="row auction-entry py-3 pe-md-2 hover-highlight rounded-3">
        <!-- Product image -->
        <a href="auction.php" class="col-md-3 col-lg-2 mb-2 mb-md-0 d-flex align-items-center justify-content-center">
            <img class="img-thumbnail" src="https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg">        
        </a>

        <div class="col-md d-flex flex-column justify-content-between">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h4 class="d-flex align-items-center">
                        <i class="bi bi-circle-fill text-success me-2" style="font-size: 0.5em;"></i>
                        <a class="text-decoration-none link-dark" href="auction.php">Foo Fighters - Greatest Hits MP3</a>
                    </h4>
                    <span class="text-muted">Created by <a class="text-decoration-none link-dark" href="user_profile.php">carlospereira</a></span>
                </div>
                
                <button type="button" class="btn auction-bookmark hover-scale p-0 align-self-start">
                    <i class="bi bi-bookmark-plus" style="font-size: 2.5em; text-align: right"></i>
                </button>
            </div>

            <div class="row mt-3">
                <div class="col-sm d-flex flex-column justify-content-end">
                    <div class="row">
                        <div class="col">
                            <span>Current bid</span>
                            <h4 class="mb-0"><?= $current_bid ?> &euro;</h4>
                        </div>

                        <?php if ($personal_bid) { ?>
                            <div class="col">
                                <span>Your bid</span>
                                <h4 class="mb-0"><?= $personal_bid ?> &euro;</h4>
                            </div>
                        <?php } ?>
                    </div>
                </div>

                <div class="col-sm d-flex flex-column mt-3 mt-0-sm align-items-sm-end">
                    <span><span class="fw-bold" style="font-size: x-small;">Starts</span> 22 feb 2021 23:59</span>
                    <span><span class="fw-bold" style="font-size: x-small;">Ends</span> 23 feb 2021 23:59</span>
                </div>
            </div>
        </div>
    </div>

<?php
}

function filter_checkbox($name, $id, $checked = false, $master = false) { ?>
    <div class="form-check <?=$master ? "master" : ""?>">
        <input class="form-check-input" type="checkbox" id="<?=$id?>" <?=$checked ? "checked" : ""?>>
        <label class="form-check-label" for="<?=$id?>">
            <?= $name?>
        </label>
    </div>
<?php 
}

function filter_radio($label, $name, $id, $checked = false, $disabled = false) { ?>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="<?= $name ?>" id="<?= $id ?>" <?= $checked ? "checked" : "" ?> <?= $disabled ? "disabled" : "" ?>>
        <label class="form-check-label" for="<?= $id ?>">
            <?= $label ?>
        </label>
    </div>

<?php 
}
?>