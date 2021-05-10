@extends("layouts.search", ['current_page' => 'search_users'])

@section("breadcrumbs")
@include("partials.breadcrumbs", [ "pages" => [
    ["title" => "Home", "href" => route('home')],
    ["title" => "Users", "href" => route('search_users')]
]])
@endsection

@section("sorting")
<option {{ old('sort') ? "" : "checked" }}>Best Match</option>
<option value="rating" {{ old('sort') === 'rating' ? "checked" : "" }}>Rating</option>
<option value="auctions" {{ old('sort') === 'auctions' ? "checked" : "" }}>Total Auctions</option>
<option value="date" {{ old('sort') === 'date' ? "checked" : "" }}>Date Joined</option>
@endsection

@section("results")
    <p>Results for: <u>{{ old('fts') ? old('fts') : 'All' }}</u> ({{ $members->total() }})</p>

    {{-- display users --}}
    @foreach($members as $member)
        @include('partials.user_entry', ['member' => $member])
    @endforeach
@endsection

@section("filters")

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
    <p class="my-0 text-secondary">Rating</p>
    <div class="row mb-3">
        <div class="col-6 w-50">
            <label class="text-secondary" for="user_min_rating">Min</label>
            <input type="number" class="form-control hide-appearence" step="1" placeholder="0" value="{{ old('user_min_rating') }}" id="input-number-left" name="user_min_rating" aria-label="User Min Rating">
        </div>

        <div class="col-6 w-50">
            <label class="text-secondary" for="user_max_rating">Max</label>
            <input type="number" class="form-control hide-appearence" step="1" placeholder="1000" value="{{ old('user_max_rating') }}" id="input-number-right" name="user_max_rating" aria-label="User Max Rating">
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
