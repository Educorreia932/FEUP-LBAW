@extends('layouts.app')

@section('content')
    <div class="container-fluid big-boy">
        <div class="row big-boy flex-row">
            {{-- Sidebar menu --}}
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    @admin
                        <ul class="nav flex-column">
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "user_management"), "name" => "User Management", "url" => route("admin.user_management")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "reported_users"), "name" => "Reported Users", "url" => route("admin.reported_users")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "auction_management"), "name" => "Auction Management", "url" => route("admin.auction_management")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "reported_auctions"), "name" => "Reported Auctions", "url" => route("admin.reported_auctions")])
                        </ul>
                    @else
                        <ul class="nav flex-column">
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "created"), "name" => "Created Auctions", "url" => route("dashboard_created_auctions")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "bidded"), "name" => "Bidded Auctions", "url" => route("dashboard_bidded_auctions")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "bookmarked"), "name" => "Bookmarked Auctions", "url" => route("dashboard_bookmarked_auctions")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "followed"), "name" => "Followed", "url" => route("dashboard_followed")])
                        </ul>
                    @endadmin
                   

                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield("subpage")
            </main>
        </div>
    </div>
@endsection
