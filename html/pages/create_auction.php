<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/breadcrumbs.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head('Create Auction', $stylesheets); ?>

    <body class="d-flex flex-column bg-light" style="min-height: 100vh;">
        <?php site_header("Foo Fighters", "page_create_auction"); ?>


        <?php site_footer(); ?>
    </body>

</hmtl>
