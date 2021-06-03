@extends("layouts.search", ['current_page' => 'users', 'search_route' => 'search_users', 'title' => 'Users Search'])

@section("breadcrumbs")
    @include("partials.breadcrumbs", [
        "title" => "Search Results",
        "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Users", "href" => route('search_users')]
        ]
    ])
@endsection

@section("sorting")
<option {{ old('sort') ? "" : "checked" }}>Best Match</option>
<option value="rating" {{ old('sort') === 'rating' ? "checked" : "" }}>Rating</option>
<option value="auctions" {{ old('sort') === 'auctions' ? "checked" : "" }}>Total Auctions</option>
<option value="date" {{ old('sort') === 'date' ? "checked" : "" }}>Date Joined</option>
@endsection

@section("results")
    <p>Results {{$members->firstItem()}}-{{$members->lastItem()}} for: <u>{{ old('fts', 'All') }}</u> ({{ $members->total() }})</p>

    @if (count($members))
        {{-- display users --}}
        @foreach($members as $member)
            @include('partials.user_entry', ['member' => $member, 'last' => $loop->last])
        @endforeach
    @else
        {{-- No matches --}}
        <div class="d-flex flex-column align-items-center justify-content-center text-muted flex-grow-1">
            <i class="bi bi-search display-3 mb-2"></i>
            <h5 class="mb-1">No matches found</h5>
            <h6>Try changing some filters</h6>
        </div>
    @endif
@endsection

@section("filters")

{{-- https://refreshless.com/nouislider/ --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.css" rel="stylesheet">
<script defer src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.6.3/nouislider.min.js"
        integrity="sha512-EnXkkBUGl2gBm/EIZEgwWpQNavsnBbeMtjklwAa7jLj60mJk932aqzXFmdPKCG6ge/i8iOCK0Uwl1Qp+S0zowg=="
        crossorigin="anonymous"></script>
<script defer src={{ asset("js/search_results_user.js") }}></script>

<script defer src={{ asset("js/follow_users.js") }}></script>

     <!-- Options -->
     <div>
        <p class="text-secondary my-2">Options</p>

        <div class="master-checkbox-reverse">

            <div class="row">
                <div class="col">
                    @include('partials.filter_checkbox', ["name" => "Has auctions", "group" => "auction", "value" => 'has_auction', "request" => $request])
                </div>
            </div>
        </div>
    </div>


    {{-- Followed / All Users --}}
    <div class="my-3">
        <p class="text-secondary my-2">Shown Users</p>

        <div class="form-group">
            <input class="form-check-input" type="radio" name="owner_filter" id="radio-owner-any" {{ old('owner_filter') === 'follow' ? "" : "checked" }} value="all">
            <label class="form-check-label" for="radio-owner-any">
                All
            </label> <br>
            <input class="form-check-input" type="radio" name="owner_filter" id="radio-owner-followed"
                {{ (old('owner_filter') && old('owner_filter') != 'all') ? "checked" : "" }} @guest disabled @endguest>
            <label class="form-check-label" for="radio-owner-followed">
                Followed Only
            </label>
        </div>
    </div>

    {{-- User's minimum rating --}}
    @admin
    <p class="my-0 text-secondary">Rating</p>
    @endadmin
    <div class="row mb-3">

        @admin
        <div class="row">
            <div class="d-none d-md-flex">
                <div id="rating-range-slider" class="my-2 mx-4 w-100"></div>
            </div>
        </div>
        @endadmin

        <div class="@admin col-6 @endadmin">
            <label class="text-secondary" for="user_min_rating">Min @unlessadmin Rating @endadmin</label>
            <input type="number" class="form-control hide-appearence" step="1" placeholder="0" value="{{ old('user_min_rating', -5) }}" id="input-number-left" name="user_min_rating" aria-label="User Min Rating">
        </div>

        @admin
        <div class="col-6">
            <label class="text-secondary" for="user_max_rating">Max</label>
            <input type="number" class="form-control hide-appearence" step="1" placeholder="1000" value="{{ old('user_max_rating', 5000) }}" id="input-number-right" name="user_max_rating" aria-label="User Max Rating">
        </div>
        @endadmin
    </div>

    <div class="form-group mt-3">
        <p class="text-secondary my-2">Joined</p>
        <div class="input-group">
            <span class="input-group-text" style="padding-right: 15px;">From</span>
            <input type="date" id="startDate" class="form-control" name="join_from" value="{{ old('join_from') }}">
        </div>
        <div class="input-group mt-2">
            <span class="input-group-text" style="padding-right: 36px;">To</span>
            <input type="date" id="endDate" class="form-control" name="join_to" value="{{ old('join_to') }}">
        </div>
    </div>

@endsection

@section("links")
    @if ($members)
        {{-- pagination links (preserving input data when moving to another page) --}}
        {!! $members->appends(request()->except('page'))->links() !!}
    @endif
@endsection
