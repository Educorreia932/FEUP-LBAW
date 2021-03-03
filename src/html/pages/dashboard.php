<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");

$stylesheets = array(
    "../css/settings.css"
);
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head("Dashboard", $stylesheets); ?>

<body class="d-flex flex-column" style="min-height: 100vh;">
    <style>
        .auction-entry img {
            height: 10em;
            width: 10em;
        }
    </style>

    <?php site_header("Foo Fighters", "page_auction"); ?>

    <div class="container-fluid" style="flex:auto;">
        <div class="row">
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="settings-account.php">
                                Created Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings-privacy.php">
                                Bidded Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings-security.php">
                                Bookmarked
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings-security.php">
                                Following
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container-fluid">
                    <h2 class="my-4">Created Auctions</h2>

                    <div>
                        <?php 
                            for ($i = 0; $i < 5; $i++) {
                        ?>
                    
                        <div class="row container auction-entry py-3">
                            <!-- Product image -->
                            <img class="col-5" src="https://images-na.ssl-images-amazon.com/images/I/81oYI%2BemsAL._SL1500_.jpg">

                            <div class="col">
                                <div class="col row">
                                    <div class="col">
                                        <h4>
                                            <a href="auction.php">Foo Fighters - Greatest Hits MP3</a>
                                            <i class="bi bi-circle-fill" style="font-size: 0.5em; color: rgb(50, 200, 50)"></i>
                                        </h4>
                                        <p>Created by carlospereira</p>
                                    </div>

                                    <div class="col">
                                        <p>Started on: 22 feb. 2021 23:59</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <p>
                                        6.66&euro; Current bid
                                    </p>
                                </div>
                            </div>

                            <div class="col-1">
                                <i class="bi bi-bookmark-plus" style="font-size: 2em"></i>
                            </div>
                        </div>

                        <?php
                            }
                        ?>
                    </div>
                </div>
            </main>
        </div>
    </div>

    <?php site_footer(); ?>
</body>

</html>