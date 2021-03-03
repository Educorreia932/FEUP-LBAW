<?php
include_once("../components/head.php");
include_once("../components/header.php");
include_once("../components/footer.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head("Foo Fighter's Profile", $stylesheets); ?>

    <body>
        <?php site_header('Foo Fighters', NULL); ?>
    
        <main>

            <div class="d-flex border border-3 rounded-3 align-items-center mx-5 my-3">
                <div class="m-2" style="width: 250px; height: 250px;">
                    <img class="img-thumbnail" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="F.F.">
                </div>
                <div class="ms-2 d-flex flex-column">
                    <h2>Foo Fighters</h2>
                    <span class="ps-2 fst-italic">@ffighters</span>
                </div>
            </div>

            <div class="d-flex flex-row mx-5 align-items-center">
                <div class="me-5">
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


        </main>
    </body>




</html>