@extends("layouts.search", ['current_page' => 'auctions', 'search_route' => 'search_auctions', 'title' => 'Auction Search'])

@inject('auc', 'App\Models\Auction')

@section("breadcrumbs")
    @include("partials.breadcrumbs", [
        "title" => "Search Results",
        "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Auctions", "href" => route('search_auctions')]
        ]
    ])
@endsection

@section("sorting")
    <option>Best Match</option>
    <option value="price" {{ old('sort') === "price" ? "checked" : "" }}>Bid Price</option>
    <option value="time" {{ old('sort') === "time" ? "checked" : "" }}>Remaining Time</option>
    <option value="date" {{ old('sort') === "date" ? "checked" : "" }}>Opening Date</option>
    {{-- <option value="bidders" {{ old('sort') === "bidders" ? "checked" : "" }}>Bidders</option> --}}
@endsection

@section("results")
    <span>Results {{$auctions->firstItem()}}-{{$auctions->lastItem()}} for: <u>{{ old('fts', 'All') }}</u> ({{ $auctions->total() }})</span>

    @if (count($auctions))
        {{-- display auctions --}}
        @foreach($auctions as $auction)
            @include('partials.auction_entry', ['auction' => $auction])
        @endforeach
    @else
        {{-- No matches --}}
        <div class="d-flex flex-column align-items-center justify-content-center text-muted flex-grow-1">
            <i class="bi bi-search display-3 mb-2"></i>
            <h5 class="mb-1">No matches found</h5>
            @if($request->has("filter_check_timeframe") && !in_array('end', $request->filter_check_timeframe))
                @php
                    $params = $request->all();
                    array_push($params["filter_check_timeframe"], "end");
                @endphp
                <h6>Looking for <a href="{{ route("search_auctions", $params) }}">auctions that have ended</a>?</h6>
            @else
                <h6>Try changing some filters</h6>
            @endif
        </div>
    @endif
@endsection

@section("filters")
    {{-- https://refreshless.com/nouislider/ --}}
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" rel="stylesheet">
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"
            integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg=="
            crossorigin="anonymous"></script>
    <script defer src={{ asset("js/search_results_auction.js") }}></script>
    <script defer src={{ asset("js/bookmark.js") }}></script>
    <script defer src={{ asset("js/master_checkboxes.js") }}></script>

    <script defer src={{ asset("js/init_tooltips.js") }}></script>

    {{-- Categories --}}
    <section aria-labelledby="ctg_title">
        <h6 id="ctg_title" class="text-secondary my-2">Category</h6>

        <div class="row">
            <div class="col">
                @foreach ($auc::CATEGORY_FORM as $key => $value)
                    @if ($loop->index % 2 == 0)
                        @include('partials.filter_checkbox', ["name" => $key, "group" => "category", "value" => $value, "request" => $request])
                    @endif
                @endforeach
            </div>

            <div class="col">
                @foreach ($auc::CATEGORY_FORM as $key => $value)
                    @if ($loop->index % 2 != 0)
                        @include('partials.filter_checkbox', ["name" => $key, "group" => "category", "value" => $value, "request" => $request])
                    @endif
                @endforeach
            </div>
        </div>
    </section>

    @can('viewNsfw', App\Models\Auction::class)
    {{-- Nsfw --}}
    <section class="my-3" id="auction-safety" aria-labelledby="age_filter_title">
        <h6 id="age_filter_title" class="text-secondary my-2">Age Rating</h6>

        @include('partials.filter_checkbox', ["name" => "Everyone", "group" => "nsfw", "value" => "sfw", "request" => $request, "default" => true])
        @include('partials.filter_checkbox', ["name" => "NSFW", "group" => "nsfw", "value" => "nsfw", "request" => $request])
    </section>
    @endcan

    {{-- Auction Owner --}}
    <section class="my-3" id="auction-owner-radios" aria-labelledby="auction_filter_title">
        <h6 id="auction_filter_title" class="text-secondary my-2">Auction Owner</h6>

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
                    aria-label="username" role="searchbox" aria-describedby="radio-owner-user-at" name="fts_user" value="{{ old('fts_user') }}" {{ old('fts_user') ? "" : "disabled" }}>
        </div>
    </section>

    {{-- Auction timeframe --}}
    <section class="my-3" aria-labelledby="auction_time_title">
        <h6 id="auction_time_title" class="text-secondary my-2">Auction timeframe</h6>

        @include('partials.filter_checkbox', ["name" => "Scheduled", "group" => "timeframe", "value" => "sched", "request" => $request, "default" => true])
        @include('partials.filter_checkbox', ["name" => "Open", "group" => "timeframe", "value" => "open", "request" => $request, "default" => true])
        @include('partials.filter_checkbox', ["name" => "Ended", "group" => "timeframe", "value" => "end", "request" => $request])
    </section>

    {{-- Current bid price range --}}
    <section class="my-3" aria-labelledby="current_bid_title">
        <h6 id="current_bid_title" class="text-secondary">Current bid (Φ)</h6>

        <div class="d-flex d-none d-md-flex">
            <div id="price-range-slider" role="slider" class="my-2 mx-4 w-100" aria-valuemin="0" aria-valuemax="10000" aria-valuenow="500"></div>
        </div>

        <div class="row mb-3">
            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                <input type="number" min="0" class="form-control hide-appearence" id="input-number-left"
                        aria-label="bid amount" name="min_bid" value="{{ old('min_bid', 0) }}">
            </div>

            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                <input type="number" min="0" class="form-control hide-appearence" id="input-number-right"
                        aria-label="bid amount" name="max_bid" value="{{ old('max_bid', 500) }}">
            </div>
        </div>
    </section>
@endsection

@section("links")
    @if ($auctions)
        {{-- pagination links (preserving input data when moving to another page) --}}
        {!! $auctions->appends(request()->except('page'))->links() !!}
    @endif
@endsection
