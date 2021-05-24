@extends('layouts.dashboard', ['sub' => 'bookmarked', 'title' => 'Bookmarked Auctions'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            @include("partials.breadcrumbs", [
                "title" => "Bookmarked Auctions",
                "pages" => [
                    ["title" => "Home", "href" => route('home')],
                    ["title" => "Me", "href" => route('my_profile')],
                    ["title" => "Dashboard", "href" => route('dashboard')],
                    ["title" => "Bookmarked Auctions", "href" => route('dashboard_bookmarked_auctions')]
                ]
            ])
        </div>

        <div>
            @each("partials.auction_entry", $auctions, "auction")
        </div>
    </div>
@endsection

