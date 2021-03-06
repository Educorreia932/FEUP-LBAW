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

        <div class="container-fluid" style="flex:auto; height: 0;">
            <div class="row h-100">
                <nav id="sidebarMenu" class="col-md-3 col-lg-2 bg-light sidebar">
                    <div class="position-sticky pt-3">

                        <h4>Settings</h4>

                        <ul class="nav flex-column">
                            <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="./settings-account.php">
                                Account
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link" href="./settings-privacy.php">
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

                    <div class="container-fluid">
                        <h2 class="my-4">Account</h2>

                        <div class="row">
                            <div class="container-fluid border rounded-3">
                                <div class="row mt-2 justify-content-between">
                                    <div class="col-lg-8 order-lg-2">
                                        <div class="row">
                                            <div class="col-4">
                                                <img class="img-fluid rounded-3" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="...">

                                                <div class="mt-3 d-grid gap-2 d-md-flex justify-content-md-center">
                                                    <button type="button" class="btn btn-secondary">Change Image</button>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <h3>Foo Fighters</h3>
                                                <h4 class="text-muted">@ffighters</h4>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-lg-4 order-lg-1">
                                        <div class="mb-3">
                                            <label class="form-label" for="name">Name</label>
                                            <input class="form-control" type="text" id="name" name="name" placeholder="Foo Fighters">
                                        </div>
                                    
                                        <label class="form-label" for="username">Username</label>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">@</span>
                                            <input type="text" class="form-control" id="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label" for="email">Email</label>
                                            <input class="form-control" type="text" id="email" name="email" placeholder="ff@jojo.net">
                                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                                        <button type="button" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="container-fluid my-4 border rounded">
                                <div class="row bg-light-grey border-rounded border-bottom">
                                    <h4>Delete Account</h4>
                                </div>
                                <div class="row">
                                    <span>Deleting your account means you cannot access it again. All your personal information will be lost. Think carefully before doing so.</span>
                                </div>
                                <div class="row">
                                    <div class="my-2 d-grid gap-2 d-flex justify-content-end">
                                        <button type="button" class="btn btn-danger">Delete Account</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <?php site_footer(); ?>

    </body>
</html>