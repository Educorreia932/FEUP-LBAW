<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_card.php");
include_once(__DIR__ . "/../components/breadcrumbs.php");

$stylesheets = array('../css/user_profile.css');
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head("Foo Fighter's Profile", $stylesheets); ?>

    <script defer src="../js/user_profile.js"></script>
    <script defer src="../js/auction-card.js"></script>

    <body class="d-flex flex-column" style="min-height: 100vh;">
        <?php site_header('Foo Fighters', NULL); ?>
        <main class="mb-4">

        </main>

        <?php site_footer() ?>
    </body>

</html>
