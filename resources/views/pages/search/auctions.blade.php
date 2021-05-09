@extends("layouts.search", ['current_page' => 'search_auctions'])

@section("breadcrumbs")
    @include("partials.breadcrumbs", [ "pages" => [
        ["title" => "Home", "href" => route('home')],
        ["title" => "Auctions", "href" => route('search_auctions')]
    ]])
@endsection

@section("sorting")
    <option {{ old('sort') ? "" : "checked" }}>Sort by</option>
    <option value="price" {{ old('sort') === "price" ? "checked" : "" }}>Bid Price</option>
    <option value="time" {{ old('sort') === "time" ? "checked" : "" }}>Remaining Time</option>
    <option value="date" {{ old('sort') === "price" ? "checked" : "" }}>Creation Date</option>
    <option value="bidders" {{ old('sort') === "bidders" ? "checked" : "" }}>Bidders</option>
    <option value="popularity" {{ old('sort') === "popularity" ? "checked" : "" }}>Popularity</option>
@endsection

@section("results")
    <p>Results for: <u>{{ old('fts') ? old('fts') : 'All' }}</u> ({{ $auctions->total() }})</p>

    {{-- display users --}}
    @foreach($auctions as $auction)
        @include('partials.auction_entry', ['auction' => $auction])
    @endforeach
@endsection

@section("filters")
    {{-- https://refreshless.com/nouislider/ --}}
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"
            integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg=="
            crossorigin="anonymous"></script>
    <script defer src={{ asset("js/search_results_auction.js") }}></script>
    <script defer src={{ asset("js/bookmark.js") }}></script>
    <script defer src={{ asset("js/master_checkboxes.js") }}></script>

    {{-- Categories --}}
    <section>
        <p class="text-secondary my-2">Category</p>

    <div class="master-checkbox-reverse">
        {{-- @include('partials.filter_checkbox', ["name" => "All", "id" => "all", "checked" => old('all'), "master" => true]) --}}

            <div class="row">
                <div class="col">
                    @include('partials.filter_checkbox', ["name" => "Games", "id" => "game", "checked" => old('filter_check_game')])
                    @include('partials.filter_checkbox', ["name" => "E-Books", "id" => "book", "checked" => old('filter_check_book')])
                    @include('partials.filter_checkbox', ["name" => "Music", "id" => "music", "checked" => old('filter_check_music')])
                </div>

                <div class="col">
                    @include('partials.filter_checkbox', ["name" => "Software", "id" => "sftw", "checked" => old('filter_check_sftw')])
                    @include('partials.filter_checkbox', ["name" => "Skins", "id" => "skin", "checked" => old('filter_check_skin')])
                    @include('partials.filter_checkbox', ["name" => "Others", "id" => "other", "checked" => old('filter_check_other')])
                </div>
            </div>
        </div>
    </section>

    {{-- Auction Owner --}}
    <section class="my-3" id="auction-owner-radios">
        <p class="text-secondary my-2">Auction Owner</p>

    <div class="form-check">
        <input class="form-check-input" type="radio" name="owner_filter" id="radio-owner-any" value="any" 
            {{ (old('owner_filter') === "any" | !old('owner_filter')) ? "checked" : "" }}>
        <label class="form-check-label" for="radio-owner-any">
            Any
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="owner_filter" id="radio-owner-followed"  
            value="follow" {{ old('owner_filter') === "follow" ? "checked" : "" }} @guest disabled @endguest>
        <label class="form-check-label" for="radio-owner-followed">
            Followed Users
        </label>
    </div>
    <div class="form-check">
        <input class="form-check-input" type="radio" name="owner_filter" id="radio-owner-user" 
            value="username" {{ old('owner_filter') === "username" ? "checked" : "" }}>
        <label class="form-check-label" for="radio-owner-user">
            Specific User
        </label>
    </div>
    <div class="input-group mb-3">
        <span class="input-group-text" id="radio-owner-user-at">@</span>
        <input type="text" id="radio-owner-user-input" class="form-control" placeholder="Username"
                aria-label="Username" aria-describedby="radio-owner-user-at" name="fts_user" value="{{ old('fts_user') }}" {{ old('fts_user') ? "" : "disabled" }}>
    </div>
</section>

    {{-- Auction timeframe --}}
    <section class="my-3">
        <p class="text-secondary my-2">Auction timeframe</p>

        @include('partials.filter_checkbox', ["name" => "Scheduled", "id" => "sche", "checked" => old('filter_check_sche')])
        @include('partials.filter_checkbox', ["name" => "Open", "id" => "open", "checked" => old('filter_check_open')])
        @include('partials.filter_checkbox', ["name" => "Ended", "id" => "end", "checked" => old('filter_check_end')])
    </section>

    {{-- Current bid price range --}}
    <div class="my-3">
        <label class="text-secondary" for="price-range">Current bid (Φ)</label>

        <div class="row">
            <div class="d-flex">
                <div id="price-range-slider" class="my-2 mx-4 w-100"></div>
            </div>

            <div class="row mb-3">
                <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                    <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                    <input type="number" min="0" class="form-control" id="input-number-left"
                           aria-label="Amount" name="min_bid" value="{{ old('min_bid') }}">
                </div>

                <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                    <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                    <input type="number" min="0" class="form-control" id="input-number-right"
                           aria-label="Amount" name="max_bid" value="{{ old('max_bid') }}">
                </div>
            </div>
        </div>
    </div>
@endsection

@section("links") 
    @if ($auctions)
        {{-- pagination links (preserving input data when moving to another page) --}}
        {!! $auctions->appends(request()->except('page'))->links() !!}
    @endif
@endsection
