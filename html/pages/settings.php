<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/general_components.php");


include_once(__DIR__ . "/../subpages/settings-account.php");
include_once(__DIR__ . "/../subpages/settings-privacy.php");
include_once(__DIR__ . "/../subpages/settings-security.php");


$href = 'settings.php';
$named = array(
    'account',
    'privacy',
    'security'
);
$subpage = isset($_GET["subpage"]) && in_array($_GET["subpage"], $named) ? $_GET["subpage"] : 'account';


$stylesheets = array(
    "../css/sidebar.css"
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
                            <?php
                                sidebar_anchor($subpage, 'account', 'Account', $href);
                                sidebar_anchor($subpage, 'privacy', 'Privacy & Notifications', $href);
                                sidebar_anchor($subpage, 'security', 'Security', $href);
                            ?>
                        </ul>
                    </div>
                </nav>

                <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                    <?php call_user_func_array('settings_' . $subpage, array()); ?>
                </main>
            </div>
        </div>

        <?php site_footer(); ?>

    </body>
</html>