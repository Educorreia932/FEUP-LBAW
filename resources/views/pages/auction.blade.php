@extends('layouts.app')

@section('content')
    <!-- Chart.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script src={{ asset("js/edit-auction-modal.js") }} defer></script>
    <script defer src={{ asset("js/auction.js") }}></script>
    <script defer src={{ asset("js/bookmark.js") }}></script>

    <div class="row m-2">
        <h1>Auction</h1>
    </div>

    <section class="container-fluid bg-light">
        <div class="row">
            <!-- Product images -->
            <div id="product-images" class="carousel slide col-md-5 h-min-content" data-bs-ride="carousel">
                <div class="carousel-indicators">
                    <button type="button" data-bs-target="#product-images" data-bs-slide-to="0" class="active"
                            aria-current="true" aria-label="Slide 1"></button>
                    <button type="button" data-bs-target="#product-images" data-bs-slide-to="1"
                            aria-label="Slide 2"></button>
                    <button type="button" data-bs-target="#product-images" data-bs-slide-to="2"
                            aria-label="Slide 3"></button>
                    <button type="button" data-bs-target="#product-images" data-bs-slide-to="3"
                            aria-label="Slide 4"></button>
                </div>

                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img class="d-block m-auto"
                             src="https://www.mobygames.com/images/covers/l/382051-jojo-s-bizarre-adventure-eyes-of-heaven-playstation-4-front-cover.png"
                             alt="...">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block m-auto"
                             src="https://hd-tecnologia.com/imagenes/articulos/2016/06/CAP-6-Jolyne_01-800x450.jpg"
                             alt="...">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block m-auto" src="https://i.ytimg.com/vi/6MFccQc1eBE/maxresdefault.jpg"
                             alt="...">
                    </div>

                    <div class="carousel-item">
                        <img class="d-block m-auto" src="https://i.ytimg.com/vi/tZd48sRoxj8/maxresdefault.jpg"
                             alt="...">
                    </div>
                </div>

                <button class="carousel-control-prev" type="button" data-bs-target="#product-images"
                        data-bs-slide="prev">
                    <span class="carousel-control-prev-icon handle-background" aria-hidden="true"></span>
                    <span class="visually-hidden">Previous</span>
                </button>

                <button class="carousel-control-next" type="button" data-bs-target="#product-images"
                        data-bs-slide="next">
                    <span class="carousel-control-next-icon handle-background" aria-hidden="true"></span>
                    <span class="visually-hidden">Next</span>
                </button>
            </div>

            <!-- Auction information -->
            <div id="auction-information" class="col-md my-4 d-flex flex-column justify-content-between">
                <!-- Product information -->
                <div class="row" id="product-information">
                    <div class="row">
                        <h2 class="col d-flex order-2 order-sm-1 order-md-2 order-lg-1 align-items-center">JoJo Eyes of
                            Heaven PS4 Key</h2>
                        <div
                            class="p-0 justify-content-center justify-content-sm-end justify-content-md-start justify-content-lg-end col-12 col-sm-4 col-md-12 col-lg-4 order-1 order-sm-2 order-md-1 order-lg-2 d-flex">
                            <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                                    data-bs-target="#report-modal">
                                <i class="bi bi-flag-fill text-danger" style="font-size:1.5em;"></i>
                                <span>Report auction</span>
                            </button>
                            <button type="button" class="btn hover-scale auction-bookmark">
                                <i class="bi bi-bookmark-plus" style="font-size: 1.5em; text-align: right"></i>
                            </button>

                            <!-- button for editing auction information (only for the user who created it) -->
                            <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                                    data-bs-target="#edit-modal">
                                <i class="bi bi-pencil" style="font-size: 1.5em; text-align: right"></i>
                            </button>
                        </div>

                    </div>
                    <p class="text-overflow-ellipsis">Eyes of Heaven is designed to be a 3D action brawler with tag-team
                        elements set in large arenas based on locations in the JoJo's Bizarre Adventure manga. Players
                        may
                        pick a single character to control in a large environment, as well as a second character that
                        may be
                        controlled by either a CPU or second human player to fight the enemy team for a 2v2 battle.
                        Certain
                        match-ups contain special animations and dialogue between two characters, mostly between allies
                        in
                        the form of unique combination attacks such as the Dual Combos (デュアルコンボ, Dyuaru Konbo) and Dual
                        Heat
                        Attacks (デュアルヒートアタック, Dyuaru Hīto Attaku), though provide no discernible bonuses or advantages
                        in
                        battle.</p>
                </div>

                <div class="row">
                    <div
                        class="col-sm-4 col-xl-6 order-sm-2 d-flex flex-column align-items-sm-end justify-content-sm-end mb-4 mb-sm-0 ml-1">
                        <h3 class="d-sm-none">Seller</h3>
                        <a href="user_profile.php"
                           class="text-decoration-none link-dark d-flex align-items-center flex-row-reverse justify-content-end flex-sm-row justify-content-sm-start">
                            <span class="ms-3 ms-sm-0 me-0 me-sm-3">Hirohiko Araki</span>
                            <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                <img style="border-radius:50%;" width="40" height="40"
                                     src="https://static.jojowiki.com/images/d/d4/latest/20200101165640/HolHorseAv.png"
                                     alt="Profile Image">
                            </div>
                        </a>
                    </div>

                    <div class="col-sm-8 col-xl-6 order-sm-1">
                        <h3>Bids</h3>
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <span>Current bid</span>
                                <h4>180.00 &euro;</h4>
                            </div>
                            <div class="col d-flex flex-column">
                                <span>Next bid starts at</span>
                                <h4>181.00 &euro;</h4>
                            </div>
                        </div>

                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text">&euro;</span>
                            </div>
                            <input type="number" class="form-control hide-appearence" placeholder="Enter bid" min="181">
                            <button class="btn bg-primary text-light" type="button" role="button">Bid</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Auction details --}}
    <section class="container-fluid p-4">
        <div class="row">
            <span class="d-flex align-items-end">
                <h3 class="m-0 p-0">Auction Details</h3>
            </span>
            <hr class="my-1">

            @include("partials.auction_detail", ["key" => "Time remaining", "value" => "24 minutes 39 seconds", "subgroup" => true])
            @include("partials.auction_detail", ["key" => "Duration", "value" => "1 week", "subgroup" => false])
            @include("partials.auction_detail", ["key" => "Bidders", "value" => "3 different bidders", "subgroup" => true])
            @include("partials.auction_detail", ["key" => "Total Bids", "value" => "7 bids", "subgroup" => false])
            @include("partials.auction_detail", ["key" => "Starting Bid", "value" => "75.00 €", "subgroup" => true])
            @include("partials.auction_detail", ["key" => "Mandatory Bid Increment", "value" => "1.00 €", "subgroup" => false])
            @include("partials.auction_detail", ["key" => "Average Bid Increment", "value" => "15.00 €", "subgroup" => false])
        </div>
    </section>

    {{-- Bid history --}}
    <section class="container-fluid p-4">
        <div class="row d-flex flex-row">
            <span class="d-flex align-items-end">
                <h3 class="m-0 p-0">Bid History</h3>
                <a class="ms-2" style="font-size: smaller;" href="auction_details">See more</a>
            </span>

            <hr class="my-1">

            {{-- Bid history chart --}}
            <div class="row col-lg-7 order-lg-2 d-flex flex-column justify-content-center">
                <canvas class="mt-4" id="bid-history-chart"></canvas>
            </div>

            {{-- Bid history table --}}
            <div class="row col-lg-5 order-lg-1">
                <table id="bid-history" class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">Bidder</th>
                        <th scope="col">Bid</th>
                        <th scope="col">Date</th>
                    </tr>
                    </thead>
                    <tbody>
                        @include("partials.bid_table_entry", ["name" => "Me", "bid" => 180, "time" => "20 sec."])

                        @for ($i = 0; $i < 6; $i++)
                            @include("partials.bid_table_entry", ["name" => "Y**p", "bid" => 15 + (10 - $i) * 15, "time" => $i + 1 . " hour"])
                        @endfor

                        @include("partials.bid_table_entry", ["name" => "Starting Bid", "bid" => 75, "time" => "1 week"])
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Edit modal --}}
    <div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modalLable" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLable">Edit Auction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="row">
                            <div class="form-group col-md-12 mt-3">
                                <label for="inputName" class="sr-only">Auction Name</label>
                                <input type="text" id="inputName" class="form-control" required>
                            </div>
                            <div class="form-group col-md-12 mt-3">
                                <label for="inputDescription" class="sr-only">Auction Description</label>
                                <textarea class="form-control" rows="4" id="inputDescription"></textarea>
                            </div>
                            <div class="form-group col-sm-12 mt-3">
                                <label for="startDate" class="sr-only">Starting on</label>
                                <div class="input-group">
                                    <input type="date" id="startDate" class="form-control">
                                    <input type="time" id="startTime" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-sm-12 mt-3">
                                <label for="endDate" class="sr-only">Ending on</label>
                                <div class="input-group">
                                    <input type="date" id="endDate" class="form-control">
                                    <input type="time" id="endTime" class="form-control">
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mt-3">
                                <label for="inputValue" class="sr-only">Starting Bid</label>
                                <div class="input-group">
                                    <input type="text" id="inputValue" class="form-control" placeholder="0.00"
                                           aria-label="euro amount (with dot and two decimal places)">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                            <div class="form-group col-sm-6 mt-3">
                                <label for="inputIncr" class="sr-only">Increment</label>
                                <div class="input-group">
                                    <input type="text" id="inputIncr" class="form-control" placeholder="0.00"
                                           aria-label="euro amount (with dot and two decimal places)">
                                    <span class="input-group-text">€</span>
                                </div>
                            </div>
                            <div class="d-flex flex-row mt-3">
                                <div class="col-sm-6">
                                    <label for="inputCategory">Category</label>
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
                                <div class="ms-3 mt-4 form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="switch-nsfw">
                                    <label class="form-check-label" for="switch-nsfw">NSFW</label>
                                </div>
                            </div>


                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    {{-- Report modal --}}
    <div class="modal fade" tabindex="-1" role="dialog" id="report-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Report auction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <div class="mb-3">
                        <select class="form-select" id="">
                            <option selected>Choose...</option>
                            <option value="1">Fraudaulent auction</option>
                            <option value="2">Improper product picutres</option>
                            <option value="3">Improper auction title</option>
                            <option value="4">Other</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <textarea class="form-control" id="report-reason" rows="6"></textarea>
                        <span class="input-group-text text-wrap">Elaborate the reason to report this auction, so we can analyze the case better.</span>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-danger">Report</button>
                </div>
            </div>
        </div>
    </div>
@endsection

