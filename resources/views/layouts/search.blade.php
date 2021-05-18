@extends('layouts.app', ['current_page' => $current_page])

@section('content')
    <script defer src="{{ asset("js/screen_size_toggle_collapse.js") }}"></script>

    <div class="container-fluid big-boy">
        <div class="row big-boy flex-row">

            <form action="{{route($search_route)}}" id="search-form" method="GET" role="search">
                @csrf

                <div class="row">
                    <nav class="col-md-3 col-xl-2 py-3 bg-light sidebar collapse" id="sidebar">
                        <div>
                            <h4>Search for</h4>

                            <ul class="nav flex-column mb-4">
                                {{-- Sidebar anchor --}}
                                @include("partials.sidebar_anchor", ['active' => ($current_page == 'auctions'), 'url' => route('search_auctions'), 'name' => 'Auctions'])
                                @include("partials.sidebar_anchor", ['active' => ($current_page == 'users'), 'url' => route('search_users'), 'name' => 'Users'])
                            </ul>

                            <h4>Filters</h4>
                                @yield("filters")
                        </div>
                    </nav>

                    <section class="col">
                        <h1 class="mt-4">Search Results</h1>
                            @yield('breadcrumbs')

                        <div class="d-flex flex-row py-4">
                            {{-- search text input --}}
                            <nav class="col-md-10 d-flex flex-row">
                                <button class="btn btn-secondary" id="btn-sidebar" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#sidebar" aria-expanded="false">
                                    <i class="bi bi-caret-right-fill"></i>
                                </button>

                                {{-- Search bar --}}
                                <section class="container input-group">
                                    <input type="search" class="form-control" placeholder="Search" aria-label="Search"
                                        aria-describedby="search-addon" name="fts" value="{{ old('fts') }}">
                                    <button type="submit" class="input-group-text border-0" id="search-addon" >
                                        <i class="bi bi-search"></i>
                                    </button>
                                </section>
                            </nav>

                            {{-- sort by options --}}
                            <div class="col-md-2">
                                <select class="form-select input-sm" name="sort">
                                    @yield('sorting')
                                </select>
                            </div>
                        </div>


                        <section class="col ms-sm-auto px-md-4">
                            {{-- Search results--}}
                            <section class="my-4">

                                @yield("results")

                                {{-- pagination links --}}
                                <nav class="d-flex justify-content-center my-4">
                                    @yield('links')
                                </nav>
                            </section>
                        </section>
                    </section>
                </div>
            </form>
        </div>
    </div>
@endsection
