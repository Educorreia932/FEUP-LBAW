<?php function auction_card_template($title, $price, $remaining_time, $img_src, $alt) { ?>

        <a href="auction.php" class="card text-decoration-none link-dark text-wrap hover-scale me-sm-3 mb-3 mb-sm-0" style="width: 12rem;">
            <img class="card-img-top w-100" style="object-fit: cover; height: 11rem;" src=<?=$img_src?> alt="<?= $alt ?>">
            <div class="card-body d-flex"  style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                <h5 class="card-title fw-5"><?=$title?></h5>
            </div>
            <div class="card-footer d-flex">
                <span class="badge bg-secondary"><?=$price?>€</span>
                <small class="text-muted ms-auto"><?=$remaining_time?> remaining</small>
            </div>
        </a>
<?php } ?>