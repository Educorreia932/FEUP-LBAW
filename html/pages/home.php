<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_card.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
<?php site_head('Home', $stylesheets); ?>

<body>
    <?php site_header("Foo Fighters", "page_home"); ?>

    <main class="flex-shrink-0 bg-light">
            <!-- Carousel div -->
            <div class="container-fluid row align-items-center m-0 mb-3" style='background-color: rgb(189, 189, 189);' >

                <!-- Carousel -->
                <div id="slides" class="carousel slide offset-lg-3 col-sm-8 col-md-6" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#slides" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#slides" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#slides" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>
                    
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/532/021/a33.png" class="d-block mx-auto" alt="...">
                            <div class="carousel-caption">
                                <h1 class="display-2">4.84&euro;</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://media.discordapp.net/attachments/688060677214044186/814885658422149180/dda7bsd-6a60b5b7-9eca-4c20-b582-5e6d1126f2ce.png?width=692&height=676" class="d-block mx-auto" alt="...">
                            <div class="carousel-caption">
                                <h1 class="display-2">23.22&euro;</h1>
                            </div>
                        </div>
                        <div class="carousel-item">
                            <img src="https://pm1.narvii.com/7609/d580c27415c4d4daba66954dd4e5a439d3578069r1-750-725v2_hq.jpg" class="d-block mx-auto" alt="...">
                            <div class="carousel-caption">
                                <h1 class="display-2">18.21&euro;</h1>
                            </div>
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#slides" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    
                    <button class="carousel-control-next" type="button" data-bs-target="#slides"  data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <div class="col my-3 mb-md-0" >
                    <h2 class="fw-bold">Featured Auctions</h2>
                    <p class="fs-3">Check out these <br> featured autions!</p>
                    <a href="#" class="text-decoration-none link-secondary">See more <i class="bi bi-arrow-right"></i></a>
                </div>   
            </div>

            <!-- Search bar -->
            <div class="container input-group">
                <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
                <button class="input-group-text border-0" id="search-addon">
                    <a class="link-dark" href="search_results.php"><i class="bi bi-search"></i></a>
                </button>
            </div>



            <!--second section-->
            <section class="py-sm-3 bg-light">
                <div class="container">
                    <div class="row"> <!-- top row -->
                        <div class="col-xl-6 mt-sm-4">
                            <hr class="d-sm-none">
                            <span class="d-flex flex-row mb-2 align-items-center">
                                <h4>Recent bids</h4>
                                <a href="search_results.php" class="ms-2 link-secondary text-decoration-none">See all <i class="bi bi-arrow-right"></i></a>
                            </span>
                            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                                <?php for ($i = 0; $i < 3; $i++)
                                    auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                        "Hatoful Boyfriend STEAM Key", "302", "3d",
                                        "https://cdn.akamai.steamstatic.com/steam/apps/310080/header.jpg?t=1568675771", "Hatoful Boyfriend") ?>
                                ?>
                            </div>
                        </div>
                        <div class="col-xl-6 mt-sm-4">
                            <hr class="d-sm-none">
                            <span class="d-flex flex-row mb-2 align-items-center">
                                <h4>Followed users' Auctions</h4>

                                <a href="search_results.php" class="ms-2 text-secondary text-decoration-none">See all <i class="bi bi-arrow-right"></i></a>
                            </span>
                            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                                <?php for ($i = 0; $i < 3; $i++)
                                    auction_card_template("me-sm-3 mb-3 mb-sm-0", "Apex Memes", 18.02, "5d", "https://media.discordapp.net/attachments/688060677214044186/817438841442664448/apex_memes.jpg")
                                ?>
                            </div>
                        </div>
                    </div> <!-- end of top row -->
                    <div class="row mt-sm-4">
                        <div class="col-lg-12">
                        <hr class="d-sm-none">
                            <span class="d-flex flex-row mb-2 align-items-center">
                                <h4>Open auctions</h4>
                                <a href="search_results.php" class="ms-2 link-secondary text-decoration-none align-items-center">See all <i class="bi bi-arrow-right"></i></a>
                            </span>
                            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                                <?php for ($i = 0; $i < 6; $i++)
                                    auction_card_template("me-sm-3 mb-3 mb-sm-0", "Jojo and the Boys", "102.23", "1w", "https://pm1.narvii.com/7609/d580c27415c4d4daba66954dd4e5a439d3578069r1-750-725v2_hq.jpg")
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
    </main>
        <?php site_footer(); ?>
        <script src="../js/auction-card.js"></script>
</body>
</hmtl>