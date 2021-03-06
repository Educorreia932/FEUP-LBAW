<?php
    include_once(__DIR__ . "/../components/head.php");
    include_once(__DIR__ . "/../components/header.php");
    include_once(__DIR__ . "/../components/footer.php");
    include_once(__DIR__ . "/../components/breadcrumbs.php");
    include_once(__DIR__ . "/../components/general_components.php");

    include_once(__DIR__ . "/../subpages/search_results-auctions.php");
    include_once(__DIR__ . "/../subpages/search_results-users.php");


    $breadcrumbs = array(
        'auctions' => 'Auctions',
        'users' => 'Users'
    );

    $href = 'search_results.php';
    $named = array('auctions', 'users');
    $subpage = isset($_GET["subpage"]) && in_array($_GET["subpage"], $named) ? $_GET["subpage"] : 'auctions';

    $stylesheets = array(
        "https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css",
        "../css/sidebar.css"
    );
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head($breadcrumbs[$subpage], $stylesheets); ?>

<body class="d-flex flex-column" style="min-height: 100vh;">
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <!-- https://refreshless.com/nouislider/ -->
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js" integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg==" crossorigin="anonymous"></script>
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
                    <h4>Search for</h4>

                    <ul class="nav flex-column mb-4">
                        <?php
                            sidebar_anchor($subpage, 'auctions', 'Auctions', $href);
                            sidebar_anchor($subpage, 'users', 'Users', $href);
                        ?>
                    </ul>

                    <h4>Filters</h4>

                    <?php call_user_func_array('search_results_' . $subpage . '_filters', array()); ?>
                </div>
            </nav>

            <main class="col ms-sm-auto px-md-4">
                <h1 class="mt-4">Search Results</h1>
                <?php breadcrumbs(array("Home", $breadcrumbs[$subpage]), array("home.php")) ?>

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
                            Sort By
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="user-dropdown">
                            <?php call_user_func_array('search_results_' . $subpage . '_ordering', array()); ?>
                        </ul>
                    </div>
                </div>

                <p>Results for: <u>Foo Fighters</u> (5)</p>

                <!-- Results -->
                <?php call_user_func_array('search_results_' . $subpage . '_results', array()); ?>

            </main>
        </div>
    </div>

    <?php site_footer(); ?>
</body>

</html>