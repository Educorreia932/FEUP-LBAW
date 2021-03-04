<?php
include_once("../components/head.php");
include_once("../components/header.php");
include_once("../components/footer.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head("Foo Fighter's Profile", $stylesheets); ?>

    <body class="d-flex flex-column" style="min-height: 100vh;">
        <?php site_header('Foo Fighters', NULL); ?>
    
        <main>
            <div class="mx-auto w-75">
                <div class="d-flex flex-column flex-md-row border border-3 rounded-3 align-items-center mx-1 my-3">
                    <div class="m-2" style="width: 250px; height: 250px;">
                        <img class="img-thumbnail" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="F.F.">
                    </div>
                    <div class="ms-2 d-flex flex-column">
                        <h2>Foo Fighters</h2>
                        <span class="ps-2 fst-italic">@ffighters</span>
                    </div>
                </div>
    
                <div class="d-flex flex-column flex-md-row ms-1 align-items-md-center">
                    <div class="mb-2 mb-md-0 me-md-5">
                        <span>Member since 23 feb 2021</span>
                    </div>
                    <div class="d-flex flex-row align-items-center">
                        <span>User reviews</span>
                        <div class="ms-2 d-flex flex-row">
                            <div class="d-flex flex-row me-2 align-items-center">
                                <div class="me-1">
                                    <span>16</span>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-success">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus" viewBox="0 0 16 16">
                                            <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            <div class="d-flex flex-row align-items-center">
                                <div class="me-1">
                                    <span>4</span>
                                </div>
                                <div class="">
                                    <button type="button" class="btn btn-outline-danger">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash" viewBox="0 0 16 16">
                                            <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex flex-column">
                    <div class="d-flex flex-row align-items-center">
                        <h3 class="fw-bold pe-2">Created Auctions</h3>
                        <a href="#">See all</a>
                    </div>

                    <div class="d-flex">
                        <div class="card-group">
                            <div class="card">
                                <div class="card-img w-100">
                                    <img src="https://i.kym-cdn.com/photos/images/newsfeed/001/532/021/a33.png" class="border-bottom border-3 card-img-top" alt="PlantIO">
                                </div>
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="card-title">PlantIO</h5>
                                </div>
                                <div class="card-footer d-flex">
                                    <a class="text-muted" href="#">See details</a>
                                    <small class="text-muted ms-auto">30min remaining</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://media.discordapp.net/attachments/688060677214044186/814885658422149180/dda7bsd-6a60b5b7-9eca-4c20-b582-5e6d1126f2ce.png?width=692&height=676" class="border-bottom border-3 card-img-top" alt="Jojorby">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="card-title">Jojorby</h5>
                                </div>
                                <div class="card-footer d-flex">
                                    <a class="text-muted" href="#">See details</a>
                                    <small class="text-muted ms-auto">3h remaining</small>
                                </div>
                            </div>
                            <div class="card">
                                <img src="https://pm1.narvii.com/7609/d580c27415c4d4daba66954dd4e5a439d3578069r1-750-725v2_hq.jpg" class="border-bottom border-3 card-img-top" alt="JoJo and the Boys">
                                <div class="card-body d-flex align-items-center">
                                    <h5 class="card-title">Jojo and the Boys</h5>
                                </div>
                                <div class="card-footer d-flex">
                                    <a class="text-muted" href="#">See details</a>
                                    <small class="text-muted ms-auto">4d remaining</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <?php site_footer() ?>
    </body>

</html>