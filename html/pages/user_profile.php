<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head("Foo Fighter's Profile", $stylesheets); ?>

    <body class="d-flex flex-column" style="min-height: 100vh;">
        <?php site_header('Foo Fighters', NULL); ?>
        <main>
            <div class="m-2 m-md-0 mt-4">
                <div class="offset-md-2 col-md-8 row border-md border-3 rounded-3" style="min-height: 300px;">
                    <div class="col-md d-flex justify-content-center">
                        <img class="img-thumbnail" style="width:300px; height: 300px; object-fit: cover;" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="F.F.">
                    </div>
                    <div class="ps-2 pt-2 col-md d-flex">
                        <div class="d-flex flex-column mb-4">
                            <h2 class="fw-bold">Foo Fighters</h2>
                            <span class="fst-italic">@ffighters</span>
                            <span class="mt-auto">Joined on 23 feb 2020</span>
                        </div>
                        <div class="ms-auto">
                            <!-- <button type="button" class="btn hover-scale">
                                <i class="bi bi-exclamation-triangle" style="font-size: 2.5em;"></i>
                            </button> -->
                            <button type="button" class="btn hover-scale p-0">
                                <i class="bi bi-pencil" style="font-size: 2.5em;"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="offset-md-2 col-md-4 mt-2">
                    <h2 class="fs-bold">Feedback</h2>
                    <table id="bid-history" class="table table-striped table-hover">
                        <thead>
                            <tr>
                            <th scope="col"></th>
                            <th scope="col">Total</th>
                            <th scope="col">6 months</th>
                            <th scope="col">Last month</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-plus-circle text-success" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                                    </svg>
                                </td>
                                <td>23</td>
                                <td>19</td>
                                <td>3</td>
                            </tr>
                            <tr>
                                <td>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-dash-circle text-danger" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                        <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                                    </svg>
                                </td>
                                <td>6</td>
                                <td>1</td>
                                <td>1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="offset-md-2 col-md-8 mt-2">
                    <h2 class="fs-bold">Created Auctions</h2>
                </div>
            </div>
        </main>

        <?php site_footer() ?>
    </body>

</html>