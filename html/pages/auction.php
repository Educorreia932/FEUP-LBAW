<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_components.php");
include_once(__DIR__ . "/../components/breadcrumbs.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">

<?php site_head('JoJo Eyes of Heaven PS4 Key', $stylesheets); ?>

<body>
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <script defer src="../js/auction.js"></script>
    <script defer src="../js/bookmark.js"></script>

    <main>
        <div class="row m-2">
            <h1>Auction</h1>
            <?php breadcrumbs(array("Home", "Auctions", "JoJo Eyes of Heaven PS4 Key"), array("home.php", "search-results.php")); ?>
        </div>

        <section class="container-fluid bg-light">

            <div class="row">
                <!-- Product images -->
                <div id="product-images" class="carousel slide col-md-5 h-min-content" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="3" aria-label="Slide 4"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img class="d-block m-auto" src="https://www.mobygames.com/images/covers/l/382051-jojo-s-bizarre-adventure-eyes-of-heaven-playstation-4-front-cover.png" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block m-auto" src="https://hd-tecnologia.com/imagenes/articulos/2016/06/CAP-6-Jolyne_01-800x450.jpg" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block m-auto" src="https://i.ytimg.com/vi/6MFccQc1eBE/maxresdefault.jpg" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img class="d-block m-auto" src="https://i.ytimg.com/vi/tZd48sRoxj8/maxresdefault.jpg" alt="...">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#product-images" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon handle-background" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#product-images" data-bs-slide="next">
                        <span class="carousel-control-next-icon handle-background" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Auction information -->
                <div id="auction-information" class="col-md my-4 d-flex flex-column justify-content-between">
                    <!-- Product information -->
                    <div class="row" id="product-information">
                        <div class="d-flex justify-content-between align-items-center">
                            <h2>JoJo Eyes of Heaven PS4 Key</h2>
                            <button type="button" class="btn hover-scale auction-bookmark">
                                <i class="bi bi-bookmark-plus" style="font-size: 2.5em; text-align: right"></i>
                            </button>
                        </div>
                        <p class="text-overflow-ellipsis">Eyes of Heaven is designed to be a 3D action brawler with tag-team elements set in large arenas based on locations in the JoJo's Bizarre Adventure manga. Players may pick a single character to control in a large environment, as well as a second character that may be controlled by either a CPU or second human player to fight the enemy team for a 2v2 battle. Certain match-ups contain special animations and dialogue between two characters, mostly between allies in the form of unique combination attacks such as the Dual Combos (デュアルコンボ, Dyuaru Konbo) and Dual Heat Attacks (デュアルヒートアタック, Dyuaru Hīto Attaku), though provide no discernible bonuses or advantages in battle.</p>
                    </div>

                    <div class="row">
                        <div class="col-sm-4 col-xl-6 order-sm-2 d-flex flex-column align-items-sm-end justify-content-sm-end mb-4 mb-sm-0 ml-1">
                            <h3 class="d-sm-none">Seller</h3>
                            <a href="#" class="text-decoration-none link-dark d-flex align-items-center flex-row-reverse justify-content-end flex-sm-row justify-content-sm-start">
                                Hirohiko Araki
                                <i class="bi bi-person-circle mx-1" style="font-size: 1.2rem;"></i>
                            </a>
                        </div>

                        <div class="col-sm-8 col-xl-6 order-sm-1">
                            <h3>Bids</h3>
                            <div class="row">
                                <div class="col d-flex flex-column">
                                    <span>Current bid</span>
                                    <h4>180.00 &euro;</h4>
                                </div>
                                <div class="col d-flex flex-column">
                                    <span>Next bid starts at</span>
                                    <h4>181.00 &euro;</h4>
                                </div>
                            </div>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">&euro;</span>
                                </div>
                                <input type="number" class="form-control hide-appearence" placeholder="Enter bid" min="181">
                                <button class="btn bg-primary text-light" type="button" role="button">Bid</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="container-fluid p-4">
            <div class="row">
                <span class="d-flex align-items-end">
                    <h3 class="m-0 p-0">Auction Details</h3>
                </span>
                <hr class="my-1">

                <?php
                    auction_detail("Time remaining", "24 minutes 39 seconds", true);
                    auction_detail("Duration", "1 week");

                    auction_detail("Bidders", "3 different bidders", true);
                    auction_detail("Total Bids", "7 bids");

                    auction_detail("Starting Bid", "75.00 €", true);
                    auction_detail("Mandatory Bid Increment", "1.00 €");
                    auction_detail("Average Bid Increment", "15.00 €");
                ?>
            </div>
        </section>

        <section class="container-fluid p-4">
            <div class="row d-flex flex-row">
                <span class="d-flex align-items-end">
                    <h3 class="m-0 p-0">Bid History</h3>
                    <a class="ms-2" style="font-size: smaller;" href="../pages/auction_details.php">See more</a>
                </span>
                <hr class="my-1">

                <div class="row col-lg-7 order-lg-2 d-flex flex-column justify-content-center">
                    <canvas class="mt-4" id="bid-history-chart"></canvas>
                </div>

                <div class="row col-lg-5 order-lg-1">
                    <table id="bid-history" class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col">Bidder</th>
                            <th scope="col">Bid</th>
                            <th scope="col">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                bid_table_entry("Me", 180, "20 sec");

                                for ($i = 0; $i < 6; $i++) 
                                    bid_table_entry($i % 2 == 0 ? 'Y**p' : 'a**U', 15 + (10 - $i) * 15, strval($i + 1) . " hour");

                                bid_table_entry("Starting Bid", 75, "1 week");
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>
    </main>

    <?php site_footer(); ?>
</body>

</html>
