<?php function notification_entry_user_auction($user, $auction, $start_bid) { ?>
    <div class="d-flex justify-content-between">
        <span>Followed user <a href="user_profile.php" class="link-dark"><?= $user ?></a> created a new auction for <a href="auction.php" class="link-dark"><?= $auction ?></a> with a starting bid of <strong class="fw-bold"><?= $start_bid ?>€</strong></span>
        <button class="btn hover-scale ms-1">
            <i class="bi bi-eye" style="font-size:x-large;"></i>
        </button>
    </div>
<?php } ?>

<?php function notification_entry_user_follow($user) { ?>
    <div class="d-flex justify-content-between">
        <span>User <a href="user_profile.php" class="link-dark"><?= $user ?></a> just started following you!</span>
        <button class="btn hover-scale ms-1">
            <i class="bi bi-eye" style="font-size:x-large;"></i>
        </button>
    </div>
<?php } ?>

<?php function notification_entry_outbid($auction, $ammount) { ?>
    <div class="d-flex justify-content-between">
        <span>You were outbid on <a href="auction.php" class="link-dark"><?= $auction ?></a> auction for <strong class="fw-bold"><?= $ammount ?>€</strong></span>
        <button class="btn hover-scale ms-1">
            <i class="bi bi-eye" style="font-size:x-large;"></i>
        </button>
    </div>
<?php } ?>
