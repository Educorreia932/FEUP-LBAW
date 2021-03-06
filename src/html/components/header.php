<?php function site_header($user, $current_page) {?>
    <header class="navbar navbar-expand-md navbar-dark bg-dark py-2">
        <nav class="container-fluid flex-wrap flex-md-nowrap mx-0" aria-label="Main Navigation">
            <a class="navbar-brand p-0 me-md-3 mx-auto fs-4" aria-label="Trade-a-Bid" href="/">
                <img src="../../static/logo.svg" width="60" height="60" alt="Trade-a-Bid">
                <span>Trade-a-Bid</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteHeader" aria-controls="siteHeader" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ps-2 ps-md-0" id="siteHeader">
                <ul class="container-fluid navbar-nav flex-row flex-wrap m-0 p-0 mt-2 mt-md-0 pt-2 pt-md-0">
                    <li class="nav-item col-6 col-md-auto">
                        <?php if ($current_page == "page_home") { ?>
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        <?php } else {?>
                            <a class="nav-link" href="/">Home</a>
                        <?php }?>
                    </li>
                    <div class="d-flex p-0 col-6 col-md-auto flex-column flex-md-row" id="headerAuctionSection">
                        <span class="d-block d-md-none text-secondary text-capitalize header-section-title">Auctions</span>
                        <li class="nav-item">
                            <?php if ($current_page == "page_auctions") { ?>
                                <a class="nav-link active" aria-current="page" href="search_results.php">Auctions</a>
                            <?php } else {?>
                                <a class="nav-link" href="search_results.php">Auctions</a>
                            <?php }?>
                        </li>
                        <li class="nav-item">
                            <?php if ($current_page == "page_create_auction") { ?>
                                    <a class="nav-link active" aria-current="page" href="create_auction.php">Sell Item</a>
                            <?php } else {?>
                                    <a class="nav-link" href="create_auction.php">Sell Item</a>
                            <?php }?>
                        </li>
                    </div>
                </ul>

                <hr class="d-md-none text-white-50">

                <ul class="navbar-nav flex-row ms-md-auto me-md-4">
                    <?php if ($user != NULL) { ?>
                        <li class="d-none d-md-flex nav-item dropdown">
                            <button class="btn btn-dark dropdown-toggle" type="button" id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span><?=htmlentities($user)?></span>
                                <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                            </button>
                        
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                                <li><a class="dropdown-item" href="settings-account.php">Settings</a></li>
                                <li><a class="dropdown-item" href="">Sign out</a></li>
                            </ul>
                        </li>
                        <div class="d-flex d-md-none flex-wrap flex-row w-100">
                            <li class="nav-item col-12">
                                <i class="bi bi-person-circle navbar-text" style="font-size: 1.2rem;"></i>
                                <span class="navbar-text"><?=htmlentities($user)?></html></span>
                            </li>
                            <li class="nav-item col-6"><a class="nav-link" href="profile.html">Profile</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="settings.html">Settings</a></li>
                            <li class="nav-item col-12"><a class="nav-link" href="">Sign out</a></li>
                        </div>
                    <?php } else { ?>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link px-2" href="signin.php">Sign in</a>
                        </li>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="d-inline-block d-md-block nav-link border border-white rounded-3 px-2" href="signup.php">Sign up</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>
    </header>
<?php } ?>