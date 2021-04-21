<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.0/font/bootstrap-icons.css">

    <!-- Styles -->
    <link href="{{ asset('css/authentication.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap_extension.css') }}" rel="stylesheet">
    <link href="{{ asset('css/sidebar.css') }}" rel="stylesheet">
    <link href="{{ asset('css/slider.css') }}" rel="stylesheet">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/user_profile.css') }}" rel="stylesheet">

    <script type="text/javascript">
        // Fix for Firefox autofocus CSS bug
        // See: http://stackoverflow.com/questions/18943276/html-5-autofocus-messes-up-css-loading/18945951#18945951
    </script>
</head>

<body>
    <header class="navbar navbar-expand-md navbar-dark bg-dark py-2">
        <nav class="container-fluid flex-wrap flex-md-nowrap mx-0" aria-label="Main Navigation">
            <a class="navbar-brand p-0 me-md-3 mx-auto fs-4" aria-label="Trade-a-Bid" href="/">
                <img src={{ asset('images/logo.svg') }} width="60" height="60" alt="Trade-a-Bid">
                <span>Trade-a-Bid</span>
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteHeader" aria-controls="siteHeader" aria-expanded="false" aria-label="Toggle Navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse ps-2 ps-md-0" id="siteHeader">
                <ul class="container-fluid navbar-nav flex-row flex-wrap m-0 p-0 mt-2 mt-md-0 pt-2 pt-md-0">
                    <li class="nav-item col-6 col-md-auto">
                        <?php
                        $current_page = "page_home";
                        $user = "Educorreia";

                        if ($current_page == "page_home") { ?>
                            <a class="nav-link active" aria-current="page" href="/">Home</a>
                        <?php }

                        else {?>
                            <a class="nav-link" href="/">Home</a>
                        <?php }?>
                    </li>
                    <div class="d-flex p-0 col-6 col-md-auto flex-column flex-md-row" id="headerAuctionSection">
                        <!-- <span class="d-block d-md-none text-secondary text-capitalize header-section-title">Auctions</span> -->
                        <li class="nav-item">
                            <?php if ($current_page == "page_search_auctions") { ?>
                                <a class="nav-link active" aria-current="page" href="search">Auctions</a>
                            <?php } else {?>
                                <a class="nav-link" href="search">Auctions</a>
                            <?php }?>
                        </li>
                        <li class="nav-item">
                            <?php if ($current_page == "page_search_users") { ?>
                                <a class="nav-link active" aria-current="page" href="search_results.php?subpage=users">Users</a>
                            <?php } else {?>
                                <a class="nav-link" href="search_results.php?subpage=users">Users</a>
                            <?php }?>
                        </li>
                        <li class="nav-item">
                            <?php if ($current_page == "page_create_auction") { ?>
                                    <a class="nav-link active" aria-current="page" href="create_auction.php">Sell Item</a>
                            <?php } else {?>
                                    <a class="nav-link" href="create_auction.php">Sell Item</a>
                            <?php }?>
                        </li>
                    </div>
                </ul>

                <hr class="d-md-none text-white-50">

                <ul class="navbar-nav flex-row ms-md-auto me-md-4">
                    <?php if ($user != NULL) { ?>
                        <button class="d-none d-md-block btn hover-scale position-relative align-middle me-2 px-4" type="button" data-bs-toggle="modal" data-bs-target="#notifications-modal">
                            <i class="bi bi-bell position-absolute top-50 start-50 translate-middle text-center text-white" style="font-size:xx-large;"></i>
                            <span class="position-absolute top-50 start-50 translate-middle text-center text-white"  style="font-size:small; font-weight: bold;">42</span>
                        </button>

                        <li class="d-none d-md-flex nav-item dropdown px-1">
                            <button class="btn btn-dark dropdown-toggle d-flex flex-row align-items-center" type="button" id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2"><?=htmlentities($user)?></span>
                                <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                    <img style="border-radius:50%;" width="40" height="40" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="Profile Image">
                                </div>
                            </button>

                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href="dashboard">Dashboard</a></li>
                                <li><a class="dropdown-item" href="user_profile">Profile</a></li>
                                <li><a class="dropdown-item" href="settings">Settings</a></li>
                                <li><a class="dropdown-item" href="">Sign out</a></li>
                            </ul>
                        </li>
                        <div class="d-flex d-md-none flex-wrap flex-row w-100">
                            <li class="nav-item col-12 d-flex justify-content-between">
                                <div class="col-6 d-flex align-items-center">
                                    <div class="d-flex p-0 align-self-center" style="width: 32px; height: 32px;">
                                        <img style="border-radius:50%;" width="32" height="32" src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg" alt="Profile Image">
                                    </div>
                                    <span class="ms-1 navbar-text"></i> <?=htmlentities($user)?></html></span>
                                </div>
                                <button class="col-6 btn hover-scale d-flex align-items-center p-0" type="button" data-bs-toggle="modal" data-bs-target="#notifications-modal">
                                    <span class="navbar-text"><i class="bi bi-bell text-muted"></i> Notifications (42)</span>
                                </button>
                            </li>
                            <li class="nav-item col-6"><a class="nav-link" href="settings">Settings</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="user_profile">Profile</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="">Sign out</a></li>
                            <li class="nav-item col-6"><a class="nav-link" href="dashboard">Dashboard</a></li>
                        </div>
                    <?php } else { ?>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link px-2" href="signin.php">Sign in</a>
                        </li>
                        <li class="nav-item col-6 col-md-auto">
                            <a class="d-inline-block d-md-block nav-link border border-white rounded-3 px-2" href="signup.php">Sign up</a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
        </nav>

        <div class="modal fade" tabindex="-1" role="dialog" id="notifications-modal">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Notifications</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">View All</button>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <section id="content">
            @yield('content')
        </section>
    </main>

    <footer class="container-fluid mt-auto bg-dark py-2">
        <div class="row">
            <div class="ms-2 col">
                <a href="/" class="row align-items-center justify-content-start text-decoration-none">
                    <img class="col-auto" src={{ asset('images/logo.svg') }} height="60">
                    <h4 class="col-6 text-light">Trade-a-Bid</h4>
                </a>
                <span class="row text-muted">&copy; Copyright 2021 Trade-a-Bid. All rights reserved</span>
            </div>

            <div class="navbar navbar-dark col d-flex flex-column align-items-end text-end">
                <ul class="navbar-nav">
                    <li class="navbar-item">
                        <a class="nav-link" href="faq">FAQ</a>
                    </li>
                    <li class="navbar-item">
                        <a class="nav-link" href="about">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>
</body>

</html>
