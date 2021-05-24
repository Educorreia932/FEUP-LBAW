@extends('layouts.dashboard', ['sub' => 'created', 'title' => 'Created Auctions'])

@section('subpage')
    <div class="container-fluid mb-4">
        <div class="my-4">
            @include("partials.breadcrumbs", [
                "title" => "Created Auctions",
                "pages" => [
                    ["title" => "Home", "href" => route('home')],
                    ["title" => "Me", "href" => route('my_profile')],
                    ["title" => "Dashboard", "href" => route('dashboard')],
                    ["title" => "Created Auctions", "href" => route('dashboard_created_auctions')]
                ]
            ])
        </div>

        <div>
            @each("partials.auction_entry", $auctions, "auction")
        </div>
    </div>
@endsection
