<?php
include_once("../components/head.php");
include_once("../components/header.php");
include_once("../components/footer.php");

$stylesheets = array(
    "../css/settings.css"
);
?>

<!DOCTYPE html>
<html lang="en">
<?php site_head('Settings', $stylesheets); ?>

    <body class="d-flex flex-column" style="min-height: 100vh;">

        <?php site_header("Foo Fighters", "page_settings"); ?>

        <div class="container-fluid" style="flex:auto;">
            <div class="row">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                    <div class="position-sticky pt-3">

                    <h4>Settings</h4>

                    <ul class="nav flex-column">
                        <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./settings-account.php">
                            Account
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="./settings-privacy.php">
                            Privacy & Notifications
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link" href="./settings-security.php">
                            Security
                        </a>
                        </li>
                    </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">

                    <h2 class="my-4">Privacy & Notifications</h2>

                    <h3 class="mt-4 mb-2">Privacy</h3>

                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch-nsfw" checked>
                            <label class="form-check-label" for="switch-nsfw">NSFW Auctions</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch-use-data">
                            <label class="form-check-label" for="switch-use-data">Use data to improve Trade-a-Bid</label>
                        </div>
                    </div>

                    <h3 class="mt-4 mb-2">Notifications</h3>

                    <div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch-notifications">
                            <label class="form-check-label" for="switch-notifications">Notifications</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch-outbid-notifications" checked disabled>
                            <label class="form-check-label" for="switch-outbid-notifications">Outbid Notifications</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch-start-auction-notifications" checked disabled>
                            <label class="form-check-label" for="switch-start-auction-notifications">Start auction notifications</label>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" id="switch-user-activity-notifications" disabled>
                            <label class="form-check-label" for="switch-user-activity-notifications">Followed user activity notifications</label>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <?php site_footer(); ?>
    </body>

    <script src="../js/settings-switches.js"></script>
</html>