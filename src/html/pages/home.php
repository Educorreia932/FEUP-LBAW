<?php
include_once("../components/head.php");
include_once("../components/header.php");
include_once("../components/footer.php");

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
                <div class="col-sm-3" >
                    <h4></h4>
                </div>

                <!-- Carousel -->
                <div id="slides" class="carousel slide col-sm-6" data-bs-ride="carousel">
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

                <div class="col-sm-3" >
                    <h4>Featured Auctions</h4>
                    <p>Check out these featured autions!</p>
                    <a href="#">See more <i class="bi bi-arrow-right"></i></a>
                </div>   
            </div>

            <!-- Search bar -->
            <div class="container input-group">
                <input type="search" class="form-control" placeholder="Search" aria-label="Search" aria-describedby="search-addon"/>
                <button class="input-group-text border-0" id="search-addon">
                    <i class="bi bi-search"></i>
                </button>
            </div>

            <!--second section-->
            <section class="container py-5 bg-light">
                <div class="row">
                    <div class="col-md-6">
                        <span class="d-flex flex-row">
                            <h4 class='mb-0'>Recently viewed</h4>
                            <a class='ms-2' href="#"> See all <i class="bi bi-arrow-right"></i></a>
                        </span>
                        <div class="card d-flex flex-row">
                            <img class="card-img img-thumbnail" src="https://i.kym-cdn.com/photos/images/newsfeed/001/532/021/a33.png" alt="...">
                            <img class="card-img img-thumbnail" src="https://cdn.discordapp.com/attachments/688060677214044186/814885346055028766/images.png" alt="...">
                            <img class="card-img img-thumbnail" src="https://media.discordapp.net/attachments/688060677214044186/814885221522079744/2Q.png" alt="...">
                        </div>
                    </div>
                    <div class=" col-md-6">
                        <span class="d-flex flex-row align-items-center">
                            <h4 class='mb-0'>Followed users</h4>
                            <a class='ms-2' href="#"> See all <i class="bi bi-arrow-right"></i></a>
                        </span>
                        <div class="card d-flex flex-row">
                            <img class="card-img img-thumbnail" src="https://media.discordapp.net/attachments/688060677214044186/814885199976333332/bb1a8785-5b0f-4394-9fc1-8c55ac2a887a.png?width=565&height=676" alt="...">
                            <img class="card-img img-thumbnail" src="https://media.discordapp.net/attachments/688060677214044186/814885181429121080/203667346-208-k571572.png" alt="...">
                            <img class="card-img img-thumbnail" src="https://media.discordapp.net/attachments/688060677214044186/814885151988777030/images.png" alt="...">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <span class="d-flex flex-row align-items-center">
                            <h4 class='mb-0'>Open auctions</h4>
                            <a class='ms-2' href="#"> See all <i class="bi bi-arrow-right"></i></a>
                        </span>
                        <div class="d-flex flex-row">
                            <div class="card text-center" style="width: 10rem; background:none; border:none; margin-top:5px;">
                                <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/532/021/a33.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                 <a href="#" class="btn btn-primary">10€</a>
                                </div>
                            </div>
                            <div class="card text-center" style="width: 10rem; background:none; border:none; margin-top:5px;">
                                <img src="https://media.discordapp.net/attachments/688060677214044186/814885181429121080/203667346-208-k571572.png" class="card-img-top" alt="...">
                                <div class="card-body">
                                 <a href="#" class="btn btn-primary">10€</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>

        <?php site_footer(); ?>
    </body>
</hmtl>