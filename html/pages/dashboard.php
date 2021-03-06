<?php
    include_once(__DIR__ . "/../components/head.php");
    include_once(__DIR__ . "/../components/header.php");
    include_once(__DIR__ . "/../components/footer.php");

    include_once(__DIR__ . "/../subpages/dashboard-subpages.php");

    $subpage_main = array(
        'dashboard_created_auctions',
        'dashboard_bidded_auctions',
        'dashboard_bookmarked_auctions',
        'dashboard_followed'
    );
    $named = array(
        'created_auctions' => 0,
        'bidded_auctions' => 1,
        'bookmarked_auctions' => 2,
        'followed' => 3
    );

    $subpage;
    if (isset($_GET["subpage"]) && array_key_exists($_GET["subpage"], $named)) {
        $subpage = $named[$_GET["subpage"]];
    } else {
        $subpage = 0;
    }

    $stylesheets = array(
        "../css/sidebar.css"
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

    <?php site_header("Foo Fighters", "page_dashboard"); ?>

    <div class="container-fluid" style="flex:auto;">
        <div class="row">
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link <?=$subpage == 0 ? 'active' : ''?>" href="dashboard.php?subpage=created_auctions">
                                Created Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?=$subpage == 1 ? 'active' : ''?>" aria-current="page" href="dashboard.php?subpage=bidded_auctions">
                                Bidded Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?=$subpage == 2 ? 'active' : ''?>" href="dashboard.php?subpage=bookmarked_auctions">
                                Bookmarked Auctions
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link <?=$subpage == 3 ? 'active' : ''?>" href="dashboard.php?subpage=followed">
                                Followed
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php $subpage_main[$subpage]() ?>
            </main>
        </div>
    </div>

    <?php site_footer(); ?>
</body>

</html>
