<?php
include_once(__DIR__ . "/../components/head.php");
include_once(__DIR__ . "/../components/header.php");
include_once(__DIR__ . "/../components/footer.php");
include_once(__DIR__ . "/../components/auction_card.php");
include_once(__DIR__ . "/../components/breadcrumbs.php");

$stylesheets = array('../css/user_profile.css');
?>

<!DOCTYPE html>
<html lang="en">
    <?php site_head("Foo Fighter's Profile", $stylesheets); ?>

    <script defer src="../js/user_profile.js"></script>

    <body class="d-flex flex-column" style="min-height: 100vh;">
        <?php site_header('Foo Fighters', NULL); ?>
        <main>
            <div class="row m-2 fs-4">
                <?php breadcrumbs(array("Home", "Users", "Me"), array("home.php", "search-results.php")); ?>
            </div>

            <div class="container">
                <div class="row justify-content-center">
                    <div class="d-flex flex-row border border-4">
                        <div class="col-8 user-details d-flex flex-row">
                            <div class="profile-avatar m-3">
                                <img width="200" height="200" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="F.F.">
                            </div>

                            <div class="d-flex flex-column mt-5 ps-2 me-2">
                                <h2 class="fw-bold">Foo Fighters</h2>
                                <span class="fst-italic mb-2">@ffighters</span>
                                <button type="button" class="follow btn btn-outline-danger">
                                    <i class="bi bi-heart"></i>
                                    <span>Follow</span>
                                </button>
                            </div> 
                        </div>
                        <div class="user-details-side d-flex flex-column align-items-end ms-2 w-100">
                            <div class="user-actions mt-1 mb-2">
                                <!-- OTHERS' PROFILE -->
                                <a class="p-0 link-dark text-decoration-none" href="search_results.php">
                                    <i class="bi bi-shop"></i>
                                    <span>Open Auctions</span>
                                </a>
                                <button type="button" class="btn ms-2 p-0">
                                    <i class="bi bi-flag-fill"></i>
                                    <span>Report user</span>
                                </button>
                                <!-- OWN PROFILE -->
                                <!-- <a class="p-0 link-dark text-decoration-none" href="settings-account.php">
                                    <i class="bi bi-gear"></i>
                                    Edit Profile
                                </a> -->
                            </div>
                            <div class="user-description d-flex flex-column-reverse w-100">
                                <a role="button" class="collapsed description-toggler" data-bs-toggle="collapse" href="#user-description" aria-expanded="false" aria-controls="user-description"></a>
                                <p class="collapse mb-1" id="user-description">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Videamus animi partes, quarum est conspectus illustrior; Ea, quae dialectici nunc tradunt et docent, nonne ab illis instituta sunt aut inventa sunt? Duo Reges: constructio interrete. Hoc etsi multimodis reprehendi potest, tamen accipio, quod dant. Hoc est non dividere, sed frangere. Effluit igitur voluptas corporis et prima quaeque avolat saepiusque relinquit causam paenitendi quam recordandi.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <div class="row">
                    <div class="col-6">
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
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <h2 class="fs-bold">Insights</h2>
    
                        <div class="container border border-3 p-0">
                            <div class="row p-2 m-0 align-items-center justify-content-center w-100 h-100">
                                <div class="col text-center">
                                    <small>Joined</small>
                                    <h4>22 feb 2020</h4>
                                </div>
                                <div class="col text-center">
                                    <small>Auctions Created</small>
                                    <h4>3502</h4>
                                </div>
                                <div class="col text-center">
                                    <small>Followers</small>
                                    <h4>63052</h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container mt-4">
                <h2 class="fs-bold">Created Auctions</h2>
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                    <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                                "Waifu Wars STEAM Key", "42", "3w",
                                    "https://cdn.akamai.steamstatic.com/steam/apps/923830/header.jpg?t=1569138289", "Waifu Wars ONLINE") ?>
                                    
                    <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                "Hatoful Boyfriend STEAM Key", "302", "3d",
                                "https://cdn.akamai.steamstatic.com/steam/apps/310080/header.jpg?t=1568675771", "Hatoful Boyfriend") ?>

                    <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                "War of the Human Tanks - ALTeR STEAM Key", "13", "14h",
                                "https://cdn.akamai.steamstatic.com/steam/apps/301920/header.jpg?t=1597504699", "War of the Human Tanks - ALTeR") ?>
                    <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                "[CS:GO] Karambit Case Hardened Factory New", "534450", "2m",
                                "http://i.gyazo.com/95ffbc8aa53f506e289c85647040002d.png", "Karambit Case Hardened Factory New") ?>
                </div>
            </div>


            <!-- <div class="m-2 mt-4 m-md-0 mt-md-4">
                <div class="offset-md-2 col-md-8 row border border-3 rounded-3" style="min-height: 300px;">
                    <div class="col-md d-flex justify-content-center">
                        <img class="avatar-large" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="F.F.">
                    </div>
                    <div class="ps-2 pt-2 col-md d-flex">
                        <div class="d-flex flex-column mb-4">
                            <h2 class="fw-bold">Foo Fighters</h2>
                            <span class="fst-italic">@ffighters</span>
                            <span class="mt-auto">Joined on 23 feb 2020</span>
                        </div>
                        <div class="ms-auto">
                            <button type="button" class="btn p-0">
                                <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5L13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175l-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                </svg>
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

                    <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                        <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                                    "Waifu Wars STEAM Key", "42", "3w",
                                        "https://cdn.akamai.steamstatic.com/steam/apps/923830/header.jpg?t=1569138289", "Waifu Wars ONLINE") ?>
                                        
                        <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                    "Hatoful Boyfriend STEAM Key", "302", "3d",
                                    "https://cdn.akamai.steamstatic.com/steam/apps/310080/header.jpg?t=1568675771", "Hatoful Boyfriend") ?>

                        <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                    "War of the Human Tanks - ALTeR STEAM Key", "13", "14h",
                                    "https://cdn.akamai.steamstatic.com/steam/apps/301920/header.jpg?t=1597504699", "War of the Human Tanks - ALTeR") ?>
                        <?php auction_card_template("me-sm-3 mb-3 mb-sm-0",
                                    "[CS:GO] Karambit Case Hardened Factory New", "534450", "2m",
                                    "http://i.gyazo.com/95ffbc8aa53f506e289c85647040002d.png", "Karambit Case Hardened Factory New") ?>
                    </div>
                </div>
            </div> -->
        </main>

        <?php site_footer() ?>
    </body>

</html>