<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_entry.php");
include_once(__DIR__ . "/../components/breadcrumbs.php");

$stylesheets = array(
    "https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css",
);
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head("Dashboard", $stylesheets); ?>

<body class="d-flex flex-column" style="min-height: 100vh;">
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <!-- https://refreshless.com/nouislider/ -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
    <script defer src="../js/search_results.js"></script>
    <script defer src="../js/bookmark.js"></script>
    <script defer src="../js/master_checkboxes.js"></script>
    <script defer src="../js/screen_size_toggle_collapse.js"></script>

    <style>
        .noUi-connect {
            background-color: var(--bs-primary);
        }
    </style>

    <div class="container-fluid" style="flex: auto;">
        <div class="row h-100">
            <nav class="col-md-3 col-xl-2 py-3 bg-light sidebar collapse" id="sidebar">
                <div>
                    <h4>Filters</h4>

                    <!-- Categories -->
                    <div>
                        <p class="text-secondary my-2">Category</p>

                        <div class="master-checkbox-reverse">
                            <?php
                            filter_checkbox("All", "a", true, true);
                            ?>
                            
                            <div class="row">
                                <div class="col">
                                    <?php
                                    filter_checkbox("Games", "b");
                                    filter_checkbox("E-Books", "c");
                                    filter_checkbox("Music", "d");
                                    ?>
                                </div>

                                <div class="col">
                                    <?php
                                    filter_checkbox("Software", "e");
                                    filter_checkbox("Skins", "f");
                                    filter_checkbox("Others", "f");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Auction Owner -->
                    <div class="my-3">
                        <p class="text-secondary my-2">Auction Owner</p>

                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-any" checked>
                            <label class="form-check-label" for="radio-owner-any">
                                Any
                            </label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-followed">
                            <label class="form-check-label" for="radio-owner-followed">
                                Followed Users
                            </label>
                        </div>
                    </div>


                    <!-- Auction timeframe -->
                    <div class="my-3">
                        <p class="text-secondary my-2">Auction timeframe</p>

                        <?php
                        filter_checkbox("Scheduled", "g");
                        filter_checkbox("Open", "h", true);
                        ?>
                    </div>

                    <!-- Current bid price range -->
                    <div class="my-3">
                        <label class="text-secondary" for="price-range">Current bid</label>
                        
                        <div class="row">
                            <div class="d-flex">
                                <div id="price-range-slider" class="my-2 mx-4 w-100">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                                <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                                <input type="text" class="form-control" id="input-number-left" aria-label="Amount (to the nearest dollar)">
                            </div>

                            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                                <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                                <input type="text" class="form-control" id="input-number-right" aria-label="Amount (to the nearest dollar)">
                            </div>
                        </div>
                    </div>
                </div>
            </nav>

            <main class="col ms-sm-auto px-md-4">
                <h1 class="mt-4">Search Results</h1>
                <?php breadcrumbs(array("Home", "Auctions"), array("home.php")) ?>

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

                <p>Results for: <u>Foo Fighters</u> (5)</p>

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