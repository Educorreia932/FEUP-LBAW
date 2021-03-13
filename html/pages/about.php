<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");

$stylesheets = array();
?>

<!DOCTYPE html>
<html lang="en">
<?php site_head('About', $stylesheets); ?>

    <body class="d-flex flex-column" style="min-height: 100vh;">

        <?php site_header(null, "page_about"); ?>

        <main class="container-fluid" style="flex:auto;">
            <div class="row bg-light-grey">          
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center text-center">
                    <figure>
                    <blockquote class="blockquote">
                        <p>It's a website.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        João Correia Lopes in <cite title="Source Title">LBAW</cite>
                    </figcaption>
                    </figure>
                </div>
                
                <div class="col-md-8 px-0">
                    <img class="img-fluid" style="max-height: 30em;" src="../static/jlopes.png" alt="...">
                </div>
            </div>

            <div class="row my-4 justify-content-center">
                <div class="col-md-10 col-lg-8 col-xl-10">
                    <div class="text-center">
                        <h3>Celebrating over 3 weeks in development!</h3>
                    </div>
                    <div class="text-start">
                        <p>Currently, most websites that provide auction services focus on physical items that must be transported from the seller to the buyer, which entails various complications such as creating false addresses to bypass shipping costs and using built-in or third-party messaging applications to transfer the item bought.</p>
                        <p>Therefore we offer a unique web platform to auction exclusively digital products.</p>
                    </div>
                </div>
            </div>

            <div class="row my-4 bg-light-grey">
                <div class="col-md-8 px-0">
                    <img class="img-fluid" style="max-height: 30em;" src="../static/lbaw_offices.png" alt="...">
                </div>
                <div class="col-md-4 d-flex flex-column align-items-center justify-content-center text-center">
                    <h3>Our offices</h3>
                    <p>Come meet us at our offices in <span style="text-decoration: line-through;">redacted</span>!</p>
                </div>
            </div>

            <div class="row m-4">
                <h3>Statistics</h3>

                <div class="container-fluid">
                    <div class="row">
                        <div class="ps-4 ps-md-0 col-md-5 text-md-center">
                            <h5>Total Auctions</h5>
                            <h6>613 484</h6>
                        </div>
                    </div>
                    <div class="row justify-content-md-center">
                        <div class="ps-4 ps-md-0 col-md-5 text-md-center">
                            <h5>Registered Losers</h5>
                            <h6>84 371</h6>
                        </div>
                    </div>
                    <div class="row justify-content-md-end">
                        <div class="ps-4 ps-md-0 col-md-5 text-md-center">
                            <h5>Brain Cells Lost</h5>
                            <h6>100 %</h6>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-4">
                <h3>Meet our Team</h3>

                <div class="d-flex flex-row align-items-stretch justify-content-between overflow-auto">
                <?php
                    team_card("Eduardo Correia", "Educorreia932", "https://github.com/Educorreia932", "../static/team/skelizard.png");
                    team_card("Ivo Saavedra", "ivSaav", "https://github.com/ivSaav", "../static/team/i_haz_bucket.png");
                    team_card("Telmo Baptista", "Telmooo", "https://github.com/Telmooo", "../static/team/toilmo.png");
                    team_card("Tiago Silva", "tiagodusilva", "https://github.com/tiagodusilva", "../static/team/homelessBanjoGuy.png");
                ?>
                </div>
            </div>
        </main>

        <?php site_footer(); ?>

    </body>
</html>


<?php function team_card($name, $username, $github, $img) { ?> 
    <div class="d-flex mx-1 flex-column justify-content-between" style="min-width: 160px;">
        <div>
            <div style="width: 140px; height: 140px;">
                <img src="<?=$img?>" class="h-100 w-100" style="border-radius: 50%; object-fit: cover;">
            </div>

            <div class="mb-2">
                <h2 class="m-0"><?=$name?></h2>
                <span>@<?=$username?></span>
            </div>
            <h6>Developer & Designer</h6>
        </div>
        <p>
            <a class="btn btn-secondary w-100" href="<?=$github?>">
                <i class="bi bi-github me-1"></i>
                View Profile »
            </a>
        </p>
      </div>
<?php } ?>
