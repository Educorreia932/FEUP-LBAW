<?php function auction_card_template($class, $img_src) { ?>

        <a href="auction.php" class="card text-decoration-none link-dark text-wrap hover-scale <?=$class?>" style="width: 12rem;">
            <img class="card-img-top w-100" style="object-fit: cover; height: 11rem;" src=<?=$img_src?> alt="F.F.">
            <div class="card-body d-flex"  style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
                <h5 class="card-title fw-5">Jojo and the Boysasasdas</h5>
            </div>
            <div class="card-footer d-flex">
                <span class="badge bg-secondary">10€</span>
                <small class="text-muted ms-auto">4d remaining</small>
            </div>
        </a>
<?php } ?>