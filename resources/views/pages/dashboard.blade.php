@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="flex: auto;">
        <div class="row h-100">
            <nav id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <div class="position-sticky pt-3">
                    <h4>Dashboard</h4>

                    <ul class="nav flex-column">
                        <?php
                        //                        sidebar_anchor($subpage, 'created_auctions', 'Created Auctions', $href);
                        //                        sidebar_anchor($subpage, 'bidded_auctions', 'Bidded Auctions', $href);
                        //                        sidebar_anchor($subpage, 'bookmarked_auctions', 'Bookmarked Auctions', $href);
                        //                        sidebar_anchor($subpage, 'followed', 'Followed', $href);
                        ?>
                    </ul>
                </div>
            </nav>

            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
{{--                @include("partials.dashboard_created_auctions")--}}
{{--                @include("partials.dashboard_bidded_auctions")--}}
{{--                @include("partials.dashboard_bookmarked_auctions")--}}
                @include("partials.dashboard_followed")
            </main>
        </div>
    </div>
@endsection
