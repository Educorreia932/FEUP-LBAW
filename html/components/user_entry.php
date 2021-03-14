<?php
function draw_user_entry($user_name, $joined, $image, $rating, $is_following=false) { ?>
    <div class="row">
        <div class="col-5 col-sm-3 col-lg-2 p-0 d-flex justify-content-center">
            <a href="user_profile.php"><img style="border-radius: 50%;" width="120" height="120" src="<?=$image?>" alt="User image"></a>
        </div>
        <div class="col-7 col-sm-9 col-lg-10">
            <div class="d-flex flex-column flex-md-row">
                <a href="user_profile.php" class="text-decoration-none text-dark col-sm-10 col-md-8 col-lg-6 col-xl-5"><h4 class="m-0 text-truncate me-2"><?=$user_name?></h4></a>
                <p class="m-0 col">(<?=$rating?> <i class="bi bi-star"></i>) <span class="text-muted"><?=$rating/5.0?>%</span></p>
            </div>
            <p><span class="text-muted">Joined on</span> <?=$joined?></p>
            <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
                <?php if ($is_following) { ?>
                    <button type="button" class="follow btn btn-danger w-100">
                        <i class="bi bi-heart-fill"></i>
                        <span>Following</span>
                    </button>
                <?php } else { ?>
                    <button type="button" class="follow btn btn-outline-danger w-100">
                        <i class="bi bi-heart"></i>
                        <span>Follow</span>
                    </button>
                <?php } ?>
            </div>
        </div>
    </div>

    <!-- <div class="d-flex flex-row py-3 pe-md-2 hover-highlight rounded-3">
        <div class="d-flex p-0 align-self-center" style="width: 120px; height:120px;">
            <a href="user_profile.php"><img style="border-radius: 50%;" width="120" height="120" src="<?=$image?>" alt="User image"></a>
        </div>

        <div class="d-flex ps-1 ps-md-2 ps-lg-3 flex-column ms-3 ms-md-4">
            <div class="d-flex flex-column flex-md-row my-2">
                <a href="user_profile.php" class="text-decoration-none text-dark"><h4 class="m-0 me-2 d-inline"><?=$user_name?></h4></a>
                <p class="m-0">(<?=$rating?> <i class="bi bi-star"></i>) <span class="text-muted"><?=$rating/5.0?>%</span></p>
            </div>
            <p><span class="text-muted">Joined on</span> <?=$joined?></p>
            <?php if ($is_following) { ?>
                <button type="button" class="follow btn btn-danger">
                    <i class="bi bi-heart-fill"></i>
                    <span>Following</span>
                </button>
            <?php } else { ?>
                <button type="button" class="follow btn btn-outline-danger">
                    <i class="bi bi-heart"></i>
                    <span>Follow</span>
                </button>
            <?php } ?>
        </div>
    </div> -->
<?php } ?>