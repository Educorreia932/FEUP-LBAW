@extends('layouts.app')

@section('content')
    <script defer src="../js/screen_size_toggle_collapse.js"></script>

    <div class="container-fluid" style="flex: auto;">
        <div class="row h-100">
            @include('partials.search_sidebar')

            <main class="col ms-sm-auto px-md-4">
                <h1 class="mt-4">Search Results</h1>

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
                            {{-- <?php call_user_func_array('search_results_' . $subpage . '_ordering', array()); ?> --}}
                        </ul>
                    </div>
                </div>

                {{-- Search results--}}
                <section>
                    <p>Results for: <u>Fighters</u> (5)</p>

                    @include('partials.auction_entry')
                </section>
            </main>
        </div>
    </div>
@endsection
