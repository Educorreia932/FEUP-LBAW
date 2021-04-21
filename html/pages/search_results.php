<?php
    include_once(__DIR__ . "/../components/head.php");
    include_once(__DIR__ . "/../components/header.php");
    include_once(__DIR__ . "/../components/footer.php");
    include_once(__DIR__ . "/../components/breadcrumbs.php");
    include_once(__DIR__ . "/../components/general_components.php");

    include_once(__DIR__ . "/../subpages/search_results-auctions.php");
    include_once(__DIR__ . "/../subpages/search_results-users.php");


    $breadcrumbs = array(
        'auctions' => 'Auctions',
        'users' => 'Users'
    );

    $href = 'search_results.php';
    $named = array('auctions', 'users');
    $subpage = isset($_GET["subpage"]) && in_array($_GET["subpage"], $named) ? $_GET["subpage"] : 'auctions';

    $stylesheets = array(
        "https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css",
        "../css/sidebar.css"
    );
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head($breadcrumbs[$subpage], $stylesheets); ?>


    
