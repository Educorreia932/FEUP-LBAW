<?php
    include_once(__DIR__ . "/../components/head.php");
    include_once(__DIR__ . "/../components/header.php");
    include_once(__DIR__ . "/../components/footer.php");
    include_once(__DIR__ . "/../components/auction_entry.php");

    $stylesheets = array(
        "../css/settings.css"
    );
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head("Dashboard", $stylesheets); ?>

<script defer src="../js/bookmark.js"></script>

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
                            <a class="nav-link" href="dashboard_created_auctions.php">
                                Created Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="dashboard_bidded_auctions.php">
                                Bidded Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_bookmarked.php">
                                Bookmarked
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="dashboard_following.php">
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
                                draw_auction_entry(6.66, 5.00);

                                echo "<hr>";
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
