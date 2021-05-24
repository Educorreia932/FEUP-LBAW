@extends('layouts.dashboard', ['sub' => 'bidded', 'title' => 'Bidded Auctions'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            @include("partials.breadcrumbs", [
                "title" => "Bidded Auctions",
                "pages" => [
                    ["title" => "Home", "href" => route('home')],
                    ["title" => "Me", "href" => route('my_profile')],
                    ["title" => "Dashboard", "href" => route('dashboard')],
                    ["title" => "Bidded Auctions", "href" => route('dashboard_bidded_auctions')]
                ]
            ])
        </div>

        <div>
            @each("partials.auction_entry", $auctions, "auction")
        </div>
    </div>
@endsection
