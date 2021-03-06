<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");

include_once(__DIR__ . "/../subpages/settings-account.php");
include_once(__DIR__ . "/../subpages/settings-privacy.php");
include_once(__DIR__ . "/../subpages/settings-security.php");


$settings_subpage = array('settings_account', 'settings_privacy', 'settings_security');
$dict = array(
    'account' => 0,
    'privacy' => 1,
    'security' => 2
);


$subpage;
if (isset($_GET["subpage"]) && array_key_exists($_GET["subpage"], $dict)) {
    $subpage = $dict[$_GET["subpage"]];
} else {
    $subpage = 0;
}


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
                            <a class="nav-link <?=$subpage == 0 ? 'active' : ''?>" aria-current="page" href="./settings.php?subpage=account">
                                Account
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link <?=$subpage == 1 ? 'active' : ''?>" href="./settings.php?subpage=privacy">
                                Privacy & Notifications
                            </a>
                            </li>
                            <li class="nav-item">
                            <a class="nav-link <?=$subpage == 2 ? 'active' : ''?>" href="./settings.php?subpage=security">
                                Security
                            </a>
                            </li>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                <?php $settings_subpage[$subpage]() ?>
                </main>
            </div>
        </div>

        <?php site_footer(); ?>

    </body>
</html>