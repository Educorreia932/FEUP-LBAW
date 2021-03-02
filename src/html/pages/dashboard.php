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
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <div class="container-fluid" style="flex:auto;">
        <div class="row">
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="settings-account.php">
                                Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings-privacy.php">
                                Privacy & Notifications
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="settings-security.php">
                                Security
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <div class="container-fluid">
                    <h2 class="my-4">Created Auctions</h2>
                </div>
            </main>
        </div>
    </div>

    <?php site_footer(); ?>
</body>

</html>