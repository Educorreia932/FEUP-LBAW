<?php
    include_once(__DIR__ . "/../components/head.php");
    include_once(__DIR__ . "/../components/header.php");
    include_once(__DIR__ . "/../components/footer.php");
    include_once(__DIR__ . "/../components/general_components.php");


    include_once(__DIR__ . "/../subpages/dashboard-subpages.php");


    $href = 'dashboard.php';
    $named = array(
        'created_auctions',
        'bidded_auctions',
        'bookmarked_auctions',
        'followed'
    );
    $subpage = isset($_GET["subpage"]) && in_array($_GET["subpage"], $named) ? $_GET["subpage"] : 'created_auctions';


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
        <div class="row h-100">
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    <ul class="nav flex-column">
                        <?php
                            sidebar_anchor($subpage, 'created_auctions', 'Created Auctions', $href);
                            sidebar_anchor($subpage, 'bidded_auctions', 'Bidded Auctions', $href);
                            sidebar_anchor($subpage, 'bookmarked_auctions', 'Bookmarked Auctions', $href);
                            sidebar_anchor($subpage, 'followed', 'Followed', $href);
                        ?>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php call_user_func_array('dashboard_' . $subpage, array()); ?>
            </main>
        </div>
    </div>

    <?php site_footer(); ?>
</body>

</html>
