@extends('layouts.app', ['current_page' => $current_page])

@section('content')
    <script defer src="{{ asset("js/screen_size_toggle_collapse.js") }}"></script>

    <div class="container-fluid" style="flex: auto;">
        <div class="row h-100">

        <nav class="col-md-3 col-xl-2 py-3 bg-light sidebar collapse" id="sidebar">
            <div>
                    <h4>Search for</h4>

                    <ul class="nav flex-column mb-4">
                        {{-- Sidebar anchor --}}
                        @include("partials.sidebar_anchor", ['active' => $current_page == 'search_auctions', 'url' => route('search_auctions'), 'name' => 'Auctions'])
                        @include("partials.sidebar_anchor", ['active' => $current_page == 'search_users', 'url' => route('search_users'), 'name' => 'Users'])
                    </ul>

                    <h4>Filters</h4>

                    @yield("filters")

                </div>
            </nav>

            <section class="col ms-sm-auto px-md-4">
                <h1 class="mt-4">Search Results</h1>

                @yield('breadcrumbs')

                <div class="d-flex flex-row py-4">
                    <button class="btn btn-secondary" id="btn-sidebar" type="button" data-bs-toggle="collapse"
                            data-bs-target="#sidebar" aria-expanded="false">
                        <i class="bi bi-caret-right-fill"></i>
                    </button>

                    {{-- Search bar --}}
                    <section class="container input-group">
                        <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                               aria-describedby="search-addon"/>
                        <button class="input-group-text border-0" id="search-addon">
                            <i class="bi bi-search"></i>
                        </button>
                    </section>

                    {{-- Sort criteria --}}
                    <div class="d-none d-md-flex nav-item dropdown">
                        <button class="btn btn-outline-secondary dropdown-toggle" type="button" id="user-dropdown"
                                role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Sort By
                        </button>

                        <ul class="dropdown-menu" aria-labelledby="user-dropdown">
                            @yield("sorting")
                        </ul>
                    </div>
                </div>

                {{-- Search results--}}
                <section class="my-4">
                    <p>Results for: <u>Fighters</u> (5)</p>

                    @yield("results")
                </section>
            </section>
        </div>
    </div>
@endsection
