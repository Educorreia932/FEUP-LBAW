@extends('layouts.app')

@section('content')
    <div class="container-fluid big-boy">
        <div class="row big-boy flex-row">
            {{-- Sidebar menu --}}
            <aside id="sidebar-menu" class="col-md-3 col-lg-2 bg-light sidebar">
                <nav class="position-sticky pt-3" aria-labelledby="dash_title">
                    <h4 id="dash_title">Dashboard</h4>

                    @admin
                        <ul class="nav flex-column">
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "user_management"), "name" => "User Management", "url" => route("admin.user_management")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "reported_users"), "name" => "Reported Users", "url" => route("admin.reported_users")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "auction_management"), "name" => "Auction Management", "url" => route("admin.auction_management")])
                            @include("partials.sidebar_anchor", [ "active" => ($sub == "reported_auctions"), "name" => "Reported Auctions", "url" => route("admin.reported_auctions")])
                        </ul>
                    @endadmin
                   

                    </nav>
            </aside>

            <section class="col-md-9 ms-sm-auto col-lg-10 px-md-4" aria-label="main">
                <div class="container-fluid mb-4">
                    @yield("page_head")

                    <div class="row">
                        {{-- search section --}}
                        <div class="col-12">
                            {{-- search text input --}}
                            <form action="{{route("admin." . $sub)}}" id="search-form" method="GET" role="search" class="row">
                                <nav class="mb-4 col-10 d-flex flex-row">
                                    {{-- Search bar --}}
                                    <div class="container input-group w-50">
                                        <input type="search" class="form-control" placeholder="Search" aria-label="search"
                                            aria-describedby="search-addon" name="fts" value="{{ old('fts') }}">
                                        <button type="submit" class="input-group-text border-0" id="search-addon" aria-label="search">
                                            <i class="bi bi-search"></i>
                                        </button>
                                    </div>
                                </nav>

                                @yield("filter_options")

                                <span>Results for: <u class="fst-italic"> @if(isset($detail_search)) {{ $detail_search }} @else {{ old('fts') ? old('fts') : 'All' }} @endif </u> ({{ $reports->total() }})</span>    
                            </form>
                        </div>
                        
                        {{-- @each("partials.auction_entry", $auctions, "auction") --}}
                        <div class="table-responsive col-12">
                            <table class="table table-hover table-striped">
                                <thead>
                                    @yield("columns")
                                </thead>
                                <tbody>
                                    @yield("table_body")
                                </tbody>
                            </table>
                        </div>  
                    </div>  
            
            
                    <nav class="d-flex justify-content-center my-4">
                        {!! $reports->appends(request()->except('page'))->links() !!}
                    </nav>
                </div>
            </section>
        </div>
    </div>
@endsection
