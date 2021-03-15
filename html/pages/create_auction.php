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

        <div class="container-fluid">
            <main class="flex-shrink-0">
                <div class="row m-4">
                    <h1>Create Auction</h1>
                    <?php breadcrumbs(array("Home", "Auctions", "Create Auction"), array("home.php", "search_results.php")) ?>
                </div>
                
                <div class="row g-3 align-items-center">
                    <!-- gallery col -->
                    <div class="col-lg-5"> 
                        <div id="uploadPreview" class="carousel carousel-dark slide col-sm-6  m-auto mt-3" data-bs-ride="carousel">
                            <div class="carousel-inner">
                                <!-- images are inserted here through js -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#uploadPreview"  data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Previous</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#uploadPreview"  data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Next</span>
                            </button>
                        </div>
                        <div class="col-12 text-center">
                            <form id="imageUpload" enctype="multipart/form-data" method="post" action="#">
                                <div class="form-group w-100 w-md-50 m-auto">
                                    <label class="form-label text-secondary" for="imageFile">Choose the images you wish to upload</label>
                                    <input  type="file" class="form-control" id="imageFile" />
                                </div>
                            </form>
                        </div>
                        <div class="image-area mt-4"><img id="imageResult" src="#" alt="" class="img-fluid rounded shadow-sm mx-auto d-block"></div>
                    </div>
                    <!-- form col -->
                    <div class="col-lg-5 pt-3 text-black-50 fs-5"> 
                        <form class="form-auction">
                            <div class="row">
                                <div class="form-group col-md-12 mt-3">
                                    <label for="inputName" class="sr-only">Auction Name</label>
                                    <input type="text" id="inputName" class="form-control" required>
                                </div>
                                <div class="form-group col-md-12 mt-3">
                                    <label for="inputDescription" class="sr-only">Auction Description</label>
                                    <textarea class="form-control" rows="4" id="comment"></textarea>
                                </div> 
                                <div class="form-group col-sm-6 mt-3">
                                    <label for="startDate" class="sr-only">Starting on</label>
                                    <div class="input-group">
                                        <input type="date" id="startDate" class="form-control">
                                        <input type="time" id="startTime" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-sm-6 mt-3">
                                    <label for="endDate" class="sr-only">Ending on</label>
                                    <div class="input-group">
                                        <input type="date" id="endDate" class="form-control">
                                        <input type="time" id="endTime" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 mt-3">
                                    <label for="inputValue" class="sr-only">Starting Bid</label>
                                    <div class="input-group">
                                        <input type="text" id="inputValue" class="form-control" placeholder="0.00" aria-label="euro amount (with dot and two decimal places)">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="form-group col-sm-4 mt-3">
                                    <label for="inputIncr" class="sr-only">Increment</label>
                                    <div class="input-group">
                                        <input type="number" id="inputIncr" class="form-control hide-appearence" placeholder="0.01" min="0.01" step="0.25" aria-label="euro amount (with dot and two decimal places)">
                                        <span class="input-group-text">€</span>
                                    </div>
                                </div>
                                <div class="col-sm-4 mt-3">
                                    <label  for="inputCategory">Category</label>
                                    <div class="input-group mb-3 col-sm-6">
                                        <select class="form-select" id="inputCategory">
                                            <option selected>Choose...</option>
                                            <option value="1">Games</option>
                                            <option value="2">Software</option>
                                            <option value="3">eBook</option>
                                            <option value="4">Music</option>
                                            <option value="5">Skins</option>
                                            <option value="6">Other</option>
                                        </select>
                                    </div>
                                </div> 
                            </div>
                            
                            <div class="d-flex flex-row  justify-content-end  mt-3  mb-3">
                                <div class="mt-2 me-3 col-sm-3 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="switch-nsfw" >
                                    <label class="form-check-label" for="switch-nsfw">NSFW</label>
                                </div>
                                <button class="btn btn-lg btn-primary btn-block text-end" type="submit">Create Auction</button> 
                            </div>
                        </form>
                    </div>
                </div>
            </main>
        </div>

        <?php site_footer(); ?>
    </body>
    <script src="../js/upload-images.js"></script>
</hmtl>