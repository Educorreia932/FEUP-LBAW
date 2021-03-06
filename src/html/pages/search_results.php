<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_entry.php");

$stylesheets = array(
    "https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css",
);
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head("Dashboard", $stylesheets); ?>

<body class="d-flex flex-column" style="min-height: 100vh;">
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
    <script defer src="../js/search_results.js"></script>
    <script defer src="../js/bookmark.js"></script>

    <style>
        .noUi-connect {
            background-color: var(--bs-primary);
        }
    </style>

    <div class="container-fluid" style="flex: auto;">
        <div class="row h-100">
            <nav class="col-md-4 col-lg-2 py-3 bg-light sidebar collapse" id="sidebar">
                <div>
                    <!-- Categories -->
                    <div>
                        <h4>Category</h4>

                        <?php
                        filter_checkbox("All", "a");
                        filter_checkbox("Games", "b");
                        filter_checkbox("E-Books", "c");
                        filter_checkbox("Music", "d");
                        filter_checkbox("Software", "e");
                        ?>
                    </div>

                    <!-- Auction timeframe -->
                    <div class="my-3">
                        <p class="text-secondary my-2">Auction timeframe</p>

                        <?php
                        filter_checkbox("Scheduled", "g");
                        filter_checkbox("Open", "h");
                        ?>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                            <label class="form-check-label" for="flexCheckDefault">
                                Scheduled
                            </label>
                        </div>

                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" checked>
                            <label class="form-check-label" for="flexCheckChecked">
                                On-going
                            </label>
                        </div>
                    </div>

                    <!-- Current bid price range -->
                    <div class="my-3">
                        <label class="text-secondary" for="price-range">Current bid</label>

                        <div class="d-flex">
                            <div id="price-range-slider" class="my-5 mx-4 w-100" />
                        </div>
                    </div>
                </div>
            </nav>

            <main class="col ms-sm-auto px-md-4">
                <div class="d-flex flex-row py-4">
                    <button class="btn btn-secondary" type="button" data-bs-toggle="collapse" data-bs-target="#sidebar">
                        &gt;
                    </button>

                    <!-- Search bar -->
                    <div class="container input-group">
                        <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                        <button class="input-group-text border-0" id="search-addon">
                            <i class="bi bi-search"></i>
                        </button>
                    </div>

                    <!-- Sort criteria -->
                    <div class="d-none d-md-flex nav-item dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Best Match
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="user-dropdown">
                            <li><a class="dropdown-item" href="#">Bid: Highest</a></li>
                            <li><a class="dropdown-item" href="#">Bid: Lowest</a></li>
                            <li><a class="dropdown-item" href="#">Time: Most Recent</a></li>
                            <li><a class="dropdown-item" href="#">Time: Finishing Soon</a></li>
                        </ul>
                    </div>
                </div>

                <p>Results for: <u>cyberpunk</u> (2)</p>

                <!-- Auctions -->
                <div>
                    <?php
                    for ($i = 0; $i < 5; $i++) {
                        draw_auction_entry(6.04, 5.01);

                        if ($i < 4)
                            echo "<hr>";
                    }
                    ?>
                </div>
            </main>
        </div>
    </div>

    <?php site_footer(); ?>
</body>

</html>