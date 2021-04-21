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



        <?php site_footer(); ?>

    </body>
</html>
