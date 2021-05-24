@extends('layouts.dashboard', ['sub' => 'created', 'title' => 'Created Auctions'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            <h2>Created Auctions</h2>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Home", "href" => "/"],
                ["title" => "Me", "href" => "/users/me"],
                ["title" => "Dashboard", "href" => "/dashboard"]
            ]])
        </div>

        <div>
            @each("partials.auction_entry", $auctions, "auction")
        </div>
    </div>
@endsection
