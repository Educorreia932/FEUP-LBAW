@extends('layouts.app')

@section('content')
    <div class="container-fluid big-boy">
        <div class="row big-boy flex-row">
            {{-- Sidebar menu --}}
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    <ul class="nav flex-column">
                        @include("partials.sidebar_anchor", [ "active" => $sub == "created", "name" => "Created Auctions", "url" => route("dashboard_created_auctions")])
                        @include("partials.sidebar_anchor", [ "active" => $sub == "bidded", "name" => "Bidded Auctions", "url" => route("dashboard_bidded_auctions")])
                        @include("partials.sidebar_anchor", [ "active" => $sub == "bookmarked", "name" => "Bookmarked Auctions", "url" => route("dashboard_bookmarked_auctions")])
                        @include("partials.sidebar_anchor", [ "active" => $sub == "followed", "name" => "Followed", "url" => route("dashboard_followed")])
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
                @yield("subpage")
            </main>
        </div>
    </div>
@endsection
