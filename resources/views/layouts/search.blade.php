@extends('layouts.app', ['current_page' => $current_page, 'title' => $title])

@section('content')
    <script defer src="{{ asset("js/screen_size_toggle_collapse.js") }}"></script>

    <div class="container-fluid big-boy">
        <form class="row big-boy flex-row" action="{{ route($search_route) }}" id="search-form" method="GET" role="search">

            @csrf

            {{-- Sidebar --}}
            <aside class="non-important-d-flex flex-column align-items-stretch justify-content-start col-12 col-md-3 col-xxl-2 p-3 bg-light sidebar collapse" id="sidebar">
                <h4>Search for</h4>

                <ul class="nav flex-column mb-4">
                    {{-- Sidebar anchor --}}
                    @include("partials.sidebar_anchor", ['active' => ($current_page == 'auctions'), 'url' => route('search_auctions'), 'name' => 'Auctions'])
                    @include("partials.sidebar_anchor", ['active' => ($current_page == 'users'), 'url' => route('search_users'), 'name' => 'Users'])
                </ul>

                <h4>Filters</h4>

                @yield("filters")
            </aside>


            {{-- Main section --}}
            <section class="d-flex flex-column align-items-stretch justify-content-start col mx-3">
                <div class="mt-4">
                    @yield('breadcrumbs')
                </div>

                <div class="d-flex flex-row justify-content-between mt-4">
                    {{-- search text input --}}
                    <nav class="col-md-10 d-flex flex-row justify-content-start">
                        <button class="btn btn-secondary" id="btn-sidebar" type="button" data-bs-toggle="collapse"
                                data-bs-target="#sidebar" aria-expanded="false" aria-label="togle sidebar">
                            <i class="bi bi-caret-right-fill"></i>
                        </button>

                        {{-- Search bar --}}
                        <div class="input-group mx-3">
                            <input type="search" class="form-control" placeholder="Search auctions" aria-label="Search " aria-describedby="search-addon"
                                name="fts" value="{{ old("fts") }}">
                            <button class="btn btn-outline-secondary" type="submit" id="search-addon"><i class="bi bi-search"></i></button>
                        </div>
                    </nav>

                    {{-- sort by options --}}
                    <div class="col-md-2">
                        <select class="form-select input-sm" name="sort">
                            @yield('sorting')
                        </select>
                    </div>
                </div>

                {{-- Search results--}}
                <section class="d-flex flex-column col flex-grow-1 mt-2 mb-4">

                    @yield("results")

                    {{-- pagination links --}}
                    <nav class="d-flex justify-content-center">
                        @yield('links')
                    </nav>
                </section>
            </section>
        </form>
    </div>
@endsection
