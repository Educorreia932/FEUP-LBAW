@extends("layouts.search", ['current_page' => 'search_users'])

@section("breadcrumbs")
@include("partials.breadcrumbs", [ "pages" => [
    ["title" => "Home", "href" => route('home')],
    ["title" => "Users", "href" => route('search_users')]
]])
@endsection

@section("sorting")
<li><a class="dropdown-item" href="#">Rating</a></li>
<li><a class="dropdown-item" href="#">Total Auctions</a></li>
<li><a class="dropdown-item" href="#">Date Joined</a></li>
@endsection

@section("results")
    {{-- display users --}}
    @foreach($members as $member)
        @include('partials.user_entry', ['member' => $member])
    @endforeach
@endsection

@section("filters")

<!-- https://refreshless.com/nouislider/ -->
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
                    @include('partials.filter_checkbox', ["name" => "Has auctions", "id" => "b", "checked" => old('filter_check')])
                </div>
            </div>
        </div>
    </div>


    <!-- Followed / All Users -->
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

    <!-- Current bid price range -->
    <div class="my-3">
        <label class="text-secondary" for="rating-range">User Rating (%)</label>

        <div class="row">
            <div class="d-flex">
                <div id="rating-range-slider" class="my-2 mx-4 w-100">
            </div>
        </div>

        <div class="row mb-3">
            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-left" class="form-label text-secondary mb-0">Min</label>
                <input type="number" class="form-control" value="{{ old('user_min_rating') }}" id="input-number-left" name="user_min_rating" aria-label="User Rating">
            </div>

            <div class="col-sm col-md-12 col-lg d-flex flex-column align-items-stretch">
                <label for="input-number-right" class="form-label text-secondary mb-0">Max</label>
                <input type="number" value="{{ old('user_max_rating') }}" class="form-control" id="input-number-right" name="user_max_rating" aria-label="User Rating">
            </div>
        </div>
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
