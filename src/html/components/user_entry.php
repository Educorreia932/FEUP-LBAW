<?php
function draw_user_entry()
{
?>

    <div class="row py-3 pe-md-2">
        <!-- User profile picture -->
        <div class="col-lg col-md-4 col-sm">
            <a href="user_profile.php"><img src="https://thispersondoesnotexist.com/image" class="img-thumbnail"></a>
        </div>

        <div class="col-lg-9 col-md col-sm-10">
            <div class="d-flex my-2">
                <a href="user_profile.php" class="text-decoration-none text-dark"><h4 class="m-0 me-2 d-inline">John Doe</h4></a>
                <p class="m-0">(571 <i class="bi bi-star"></i>) <span class="text-muted">100%</span></p>
            </div>
            <p><span class="text-muted">Added in</span> 22. feb. 2021</p>
            <button type="button" class="btn btn-dark">FOLLOWING</button>
        </div>
    </div>

<?php
}
?>