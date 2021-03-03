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
                        <a class="nav-link" href="./settings-privacy.php">
                            Privacy & Notifications
                        </a>
                        </li>
                        <li class="nav-item">
                        <a class="nav-link active" href="./settings-security.php">
                            Security
                        </a>
                        </li>
                    </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <h2 class="my-4">Security</h2>

                    <div class="col-lg-8 col-xl-6 mx-3 mx-md-0">
                        <div class="row">
                            <label class="form-label" for="pwd">Current Password</label> <br>
                            <input class="form-control" type="password" id="pwd" name="pwd">
                        </div>
                        <div class="row">
                            <label class="form-label" for="pwd">New Password</label> <br>
                            <input class="form-control" type="password" id="pwd-new" name="new-pwd">
                        </div>
                        <div class="row">
                            <label class="form-label" for="pwd">Confirm Password</label> <br>
                            <input class="form-control" type="password" id="pwd-confirmed" name="confirmed-pwd">
                        </div>

                        <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-end">
                            <button type="button" class="btn btn-danger">Change Password</button>
                        </div>
                    </div>                  
                </main>
            </div>
        </div>

        <?php site_footer(); ?>

    </body>
</html>