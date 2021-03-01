<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
    
<?php site_head('Home', $stylesheets); ?>

<body>
    <?php site_header("Foo Fighters", "page_auction"); ?>

    <style>
        .carousel-item>img {
            height: 25em;
        }
    </style>

    <script defer src="../js/auction.js"></script>

    <main>
        <section class="bg-light">
            <div class="row m-0 p-0">
                <!-- Product images -->
                <div id="product-images" class="carousel slide col-sm-6" data-bs-ride="carousel">
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="1" aria-label="Slide 2"></button>
                        <button type="button" data-bs-target="#product-images" data-bs-slide-to="2" aria-label="Slide 3"></button>
                    </div>

                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/532/021/a33.png" class="d-block mx-auto" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img src="https://media.discordapp.net/attachments/688060677214044186/814885658422149180/dda7bsd-6a60b5b7-9eca-4c20-b582-5e6d1126f2ce.png?width=692&height=676" class="d-block mx-auto" alt="...">
                        </div>

                        <div class="carousel-item">
                            <img src="https://pm1.narvii.com/7609/d580c27415c4d4daba66954dd4e5a439d3578069r1-750-725v2_hq.jpg" class="d-block mx-auto" alt="...">
                        </div>
                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#product-images" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>

                    <button class="carousel-control-next" type="button" data-bs-target="#product-images" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>

                <!-- Auction information -->
                <div id="auction-information" class="col-sm-6 row py-4">
                    <div class="col-sm-6 d-flex flex-column justify-content-between">
                        <!-- Product information -->
                        <div id="product-information">
                            <h3>Product title</h3>
                            <p>Product description</p>
                        </div>

                        <div>
                            <h3>Bids</h3>
                            <p>Starting bid 15.00&euro;</p>
                            <p>Current bid 666.66&euro;</p>

                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">&euro;</span>
                                </div>
                                <input type="number" class="form-control" placeholder="Enter bid value">
                                <button class="btn bg-primary text-light" type="button" role="button">Bid</button>
                            </div>
                        </div>
                    </div>

                    <div class="col d-flex flex-column justify-content-between">
                        <i class="bi bi-bookmark-plus" style="font-size: 2.5em; text-align: right"></i>
                        <p class="p-0 m-0" type="button" role="button" data-bs-toggle="dropdown" aria-expanded="false" style="text-align: right">
                            <span>Auction Creator</span>
                            <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Remaining time -->
        <div class="text-center card inline-block p-0">
            <p>20m 39s remaining</p>
        </div>

        <section class="bg-light">
            <div class="row">
                <h4 class="m-0 p-0">Bid History</h4>

                <hr>

                <div class="col">
                    <div id="bid-history" class="overflow-auto" style="max-height: 20em">
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                        <div class="row container m-1">
                            <div class="col-10 d-flex justify-content-between border">
                                <p class="m-0">666.66&euro;</p>
                                <div class="d-flex">
                                    <p class="m-0">Local Whale</p>
                                    <i class="bi bi-person-circle" style="font-size: 1.2rem;"></i>
                                </div>
                            </div>

                            <div class="col">
                                2 sec. ago
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <canvas id="bid-history-chart"></canvas>
                </div>
            </div>
        </section>
    </main>

    <?php site_footer(); ?>
</body>

</html>