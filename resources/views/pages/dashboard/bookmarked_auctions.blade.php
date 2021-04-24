@extends('layouts.dashboard')

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>Bookmarked Auctions</h2>
        </div>

        <div>
            @each ("partials.auction_entry", $auctions, "auction")
        </div>
    </div>
@endsection

