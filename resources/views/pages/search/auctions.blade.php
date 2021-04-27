@extends("layouts.search", ['current_page' => 'search_auctions'])

@section("breadcrumbs")
@include("partials.breadcrumbs", [ "pages" => [
    ["title" => "Home", "href" => route('home')],
    ["title" => "Auctions", "href" => route('search_auctions')]
]])
@endsection

@section("sorting")
<li><a class="dropdown-item" href="#">Bid Price</a></li>
<li><a class="dropdown-item" href="#">Remaining Time</a></li>
<li><a class="dropdown-item" href="#">Creation Date</a></li>
<li><a class="dropdown-item" href="#">Bidders</a></li>
<li><a class="dropdown-item" href="#">Popularity</a></li>
@endsection

@section("results")
    @each("partials.auction_entry", $auctions, "auction")
@endsection

@section("filters")
<!-- https://refreshless.com/nouislider/ -->
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"
        integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg=="
        crossorigin="anonymous"></script>
<script defer src={{ asset("js/search_results_auction.js") }}></script>
<script defer src={{ asset("js/bookmark.js") }}></script>
<script defer src={{ asset("js/master_checkboxes.js") }}></script>

<!-- Categories -->
<section>
    <p class="text-secondary my-2">Category</p>

    <div class="master-checkbox-reverse">
        @include('partials.filter_checkbox', ["name" => "All", "id" => "a"])

        <div class="row">
            <div class="col">
                @include('partials.filter_checkbox', ["name" => "Games", "id" => "b"])
                @include('partials.filter_checkbox', ["name" => "E-Books", "id" => "c"])
                @include('partials.filter_checkbox', ["name" => "Music", "id" => "d"])
            </div>

            <div class="col">
                @include('partials.filter_checkbox', ["name" => "Software", "id" => "e"])
                @include('partials.filter_checkbox', ["name" => "Skins", "id" => "f"])
                @include('partials.filter_checkbox', ["name" => "Others", "id" => "f"])
            </div>
        </div>
    </div>
</section>

<!-- Auction Owner -->
<section class="my-3" id="auction-owner-radios">
    <p class="text-secondary my-2">Auction Owner</p>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-any" checked>
        <label class="form-check-label" for="radio-owner-any">
            Any
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-followed">
        <label class="form-check-label" for="radio-owner-followed">
            Followed Users
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="owner-filter" id="radio-owner-user">
        <label class="form-check-label" for="radio-owner-user">
            Specific User
        </label>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="radio-owner-user-at">@</span>
        <input type="text" id="radio-owner-user-input" class="form-control" placeholder="Username"
                aria-label="Username" aria-describedby="radio-owner-user-at" disabled>
    </div>
</section>

<!-- Auction timeframe -->
<section class="my-3">
    <p class="text-secondary my-2">Auction timeframe</p>

    @include('partials.filter_checkbox', ["name" => "Scheduled", "id" => "g"])
    @include('partials.filter_checkbox', ["name" => "Open", "id" => "h"])
    @include('partials.filter_checkbox', ["name" => "Ended", "id" => "i"])
</section>

<!-- Current bid price range -->
<div class="my-3">
    <label class="text-secondary" for="price-range">Current bid (€)</label>

    <div class="row">
        <div class="d-flex">
            <div id="price-range-slider" class="my-2 mx-4 w-100"></div>
        </div>

        <div class="row mb-3">
            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                <input type="text" class="form-control" id="input-number-left"
                        aria-label="Amount (to the nearest dollar)">
            </div>

            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                <input type="text" class="form-control" id="input-number-right"
                        aria-label="Amount (to the nearest dollar)">
            </div>
        </div>
    </div>
</div>
@endsection
