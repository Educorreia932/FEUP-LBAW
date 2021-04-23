@extends('layouts.app')

@section('content')
    <script src={{ asset("js/auction-card.js") }}></script>

    <!-- Featured Auctions -->
    <section class="container-fluid row align-items-center m-0 mb-3" style='background-color: rgb(189, 189, 189);'>
        <!-- Carousel -->
        <div id="slides" class="carousel slide offset-lg-3 col-sm-8 col-md-6" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#slides" data-bs-slide-to="0" class="active" aria-current="true"
                        aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#slides" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#slides" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
                <a class="carousel-item active" href="auction.php">
                    <img
                        src="https://www.mobygames.com/images/covers/l/615072-the-talos-principle-nintendo-switch-front-cover.jpg"
                        class="d-block mx-auto" alt="...">
                </a>
                <a class="carousel-item" href="auction.php">
                    <img
                        src="https://www.mobygames.com/images/covers/l/382051-jojo-s-bizarre-adventure-eyes-of-heaven-playstation-4-front-cover.png"
                        class="d-block mx-auto" alt="...">
                </a>
                <a class="carousel-item" href="auction.php">
                    <img
                        src="https://apunkatorrents.net/wp-content/uploads/2018/08/Lagoon-Lounge-The-Poisonous-Fountain-cover.jpg"
                        class="d-block mx-auto" alt="...">
                </a>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#slides" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#slides" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        <div class="col my-3 mb-md-0">
            <h2 class="fw-bold">Featured Auctions</h2>
            <p class="fs-3">Check out these <br> featured autions!</p>
            <a href="search_results.php" class="text-decoration-none link-secondary">See more <i
                    class="bi bi-arrow-right"></i></a>
        </div>
    </section>

    <!-- Search bar -->
    <section class="container input-group w-100 w-sm-75 w-xl-50 w-xxl-25">
        <input type="search" class="form-control" placeholder="Search" aria-label="Search"
               aria-describedby="search-addon"/>
        <button class="input-group-text border-0" id="search-addon">
            <a class="link-dark" href="search_results.php"><i class="bi bi-search"></i></a>
        </button>
    </section>

    <div class="py-sm-3 bg-light container">
        <div class="row">
            {{-- Recent bids --}}
            <section class="col-xl-6 mt-sm-4">
                <hr class="d-sm-none">
                <span class="d-flex flex-row mb-2 align-items-center">
                                <h4>Recent bids</h4>
                                <a href="search_results.php" class="ms-2 link-secondary text-decoration-none">See all <i
                                        class="bi bi-arrow-right"></i></a>
                            </span>
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">

                </div>
            </section>

            {{-- Followed Users' Auctions --}}
            <section class="col-xl-6 mt-sm-4">
                <hr class="d-sm-none">
                <span class="d-flex flex-row mb-2 align-items-center">
                    <h4>Followed Users' Auctions</h4>
                    <a href="search_results.php" class="ms-2 text-secondary text-decoration-none">
                        See all <i class="bi bi-arrow-right"></i>
                    </a>
                </span>
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">

                </div>
            </section>
        </div>

        {{-- Open Auctions --}}
        <section class="row mt-sm-4 col-lg-12">
            <hr class="d-sm-none">

            <span class="d-flex flex-row mb-2 align-items-center">
                <h4>Open auctions</h4>
                <a href="search_results.php"
                   class="ms-2 link-secondary text-decoration-none align-items-center">
                    See all <i class="bi bi-arrow-right"></i>
                </a>
            </span>

            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                @each ("partials.auction_card", $open_auctions, "auction")
            </div>
        </section>
    </div>
@endsection
