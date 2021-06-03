@extends('layouts.app', ['current_page' => 'home', 'title' => 'Home'])

@section('content')
    <script src={{ asset("js/auction-card.js") }}></script>

    {{-- Site Banner --}}
    <section id="home-banner" class="mb-4 text-center d-flex flex-column justify-content-between">
        <div id="home-banner-inner" class="p-3 p-xl-5 h-100 w-100">
            <div id="home-banner-title" class="col-10 col-sm-8 col-md-5 col-xl-4 p-2 mx-auto mt-md-5 mb-4">
                <h1 class="display-4 fw-normal">Trade-a-Bid</h1>
                <p class="lead fw-normal">the future of auctions starts here</p>
            </div>

            <!-- Search bar -->
            <form action="{{ route("search_auctions") }}" method="GET"
                class="container input-group w-100 w-sm-75 w-xl-50">

                @csrf

                <div class="input-group">
                    <input type="search" class="form-control" placeholder="Search auctions" aria-label="Search for auctions" aria-describedby="search-addon"
                        name="fts" value={{ old("fts") }}>
                    <button class="btn btn-outline-secondary input-group-button-background" type="submit" id="search-addon">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
            </form>
        </div>
    </section>

    <!-- Categories -->
    <section class="container">
        <h3>Explore popular categories</h3>

        @php $cat_svg_size = "3em"; @endphp

        <ul class="d-flex justify-content-around align-items-stretch flex-wrap list-unstyled">

            <li class="home-category-all d-flex align-items-center justify-content-center">
                <a class="text-center d-flex flex-column align-items-stretch justify-content-between text-light h-100 w-100 p-3"
                        href="{{ route("search_auctions") }}">
                    <p class="text-start p-0 m-0">There are more categories to explore!</p>
                    <span class="text-end">See all <i class="bi bi-arrow-right-short"></i><span>
                </a>
            </li>

            <li>
                <form action="{{ route("search_auctions") }}" class="home-category text-dark" >
                    @csrf
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden disabled>

                    <button class="text-decoration-none" type="submit">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="{{ $cat_svg_size }}" height="{{ $cat_svg_size }}" fill="currentColor"
                                    class="bi bi-controller" viewBox="0 0 16 16">
                                <path d="M11.5 6.027a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm2.5-.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0zm-1.5 1.5a.5.5 0 1 0 0-1 .5.5 0 0 0 0 1zm-6.5-3h1v1h1v1h-1v1h-1v-1h-1v-1h1v-1z"/>
                                <path d="M3.051 3.26a.5.5 0 0 1 .354-.613l1.932-.518a.5.5 0 0 1 .62.39c.655-.079 1.35-.117 2.043-.117.72 0 1.443.041 2.12.126a.5.5 0 0 1 .622-.399l1.932.518a.5.5 0 0 1 .306.729c.14.09.266.19.373.297.408.408.78 1.05 1.095 1.772.32.733.599 1.591.805 2.466.206.875.34 1.78.364 2.606.024.816-.059 1.602-.328 2.21a1.42 1.42 0 0 1-1.445.83c-.636-.067-1.115-.394-1.513-.773-.245-.232-.496-.526-.739-.808-.126-.148-.25-.292-.368-.423-.728-.804-1.597-1.527-3.224-1.527-1.627 0-2.496.723-3.224 1.527-.119.131-.242.275-.368.423-.243.282-.494.575-.739.808-.398.38-.877.706-1.513.773a1.42 1.42 0 0 1-1.445-.83c-.27-.608-.352-1.395-.329-2.21.024-.826.16-1.73.365-2.606.206-.875.486-1.733.805-2.466.315-.722.687-1.364 1.094-1.772a2.34 2.34 0 0 1 .433-.335.504.504 0 0 1-.028-.079zm2.036.412c-.877.185-1.469.443-1.733.708-.276.276-.587.783-.885 1.465a13.748 13.748 0 0 0-.748 2.295 12.351 12.351 0 0 0-.339 2.406c-.022.755.062 1.368.243 1.776a.42.42 0 0 0 .426.24c.327-.034.61-.199.929-.502.212-.202.4-.423.615-.674.133-.156.276-.323.44-.504C4.861 9.969 5.978 9.027 8 9.027s3.139.942 3.965 1.855c.164.181.307.348.44.504.214.251.403.472.615.674.318.303.601.468.929.503a.42.42 0 0 0 .426-.241c.18-.408.265-1.02.243-1.776a12.354 12.354 0 0 0-.339-2.406 13.753 13.753 0 0 0-.748-2.295c-.298-.682-.61-1.19-.885-1.465-.264-.265-.856-.523-1.733-.708-.85-.179-1.877-.27-2.913-.27-1.036 0-2.063.091-2.913.27z"/>
                            </svg>
                        </div>
                        <span>Games</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route("search_auctions") }}" class="home-category text-dark" >
                    @csrf
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden disabled>

                    <button class="text-decoration-none" type="submit">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="{{ $cat_svg_size }}" height="{{ $cat_svg_size }}" fill="currentColor"
                                    class="bi bi-camera-reels" viewBox="0 0 16 16">
                                <path d="M6 3a3 3 0 1 1-6 0 3 3 0 0 1 6 0zM1 3a2 2 0 1 0 4 0 2 2 0 0 0-4 0z"/>
                                <path d="M9 6h.5a2 2 0 0 1 1.983 1.738l3.11-1.382A1 1 0 0 1 16 7.269v7.462a1 1 0 0 1-1.406.913l-3.111-1.382A2 2 0 0 1 9.5 16H2a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h7zm6 8.73V7.27l-3.5 1.555v4.35l3.5 1.556zM1 8v6a1 1 0 0 0 1 1h7.5a1 1 0 0 0 1-1V8a1 1 0 0 0-1-1H2a1 1 0 0 0-1 1z"/>
                                <path d="M9 6a3 3 0 1 0 0-6 3 3 0 0 0 0 6zM7 3a2 2 0 1 1 4 0 2 2 0 0 1-4 0z"/>
                            </svg>
                        </div>
                        <span>Series & Movies</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route("search_auctions") }}" class="home-category text-dark" >
                    @csrf
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden disabled>

                    <button class="text-decoration-none" type="submit">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="{{ $cat_svg_size }}" height="{{ $cat_svg_size }}" fill="currentColor"
                                    class="bi bi-code-slash" viewBox="0 0 16 16">
                                <path d="M10.478 1.647a.5.5 0 1 0-.956-.294l-4 13a.5.5 0 0 0 .956.294l4-13zM4.854 4.146a.5.5 0 0 1 0 .708L1.707 8l3.147 3.146a.5.5 0 0 1-.708.708l-3.5-3.5a.5.5 0 0 1 0-.708l3.5-3.5a.5.5 0 0 1 .708 0zm6.292 0a.5.5 0 0 0 0 .708L14.293 8l-3.147 3.146a.5.5 0 0 0 .708.708l3.5-3.5a.5.5 0 0 0 0-.708l-3.5-3.5a.5.5 0 0 0-.708 0z"/>
                            </svg>
                        </div>
                        <span>Software</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route("search_auctions") }}" class="home-category text-dark" >
                    @csrf
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden disabled>

                    <button class="text-decoration-none" type="submit">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="{{ $cat_svg_size }}" height="{{ $cat_svg_size }}" fill="currentColor"
                                    class="bi bi-music-note-beamed" viewBox="0 0 16 16">
                                <path d="M6 13c0 1.105-1.12 2-2.5 2S1 14.105 1 13c0-1.104 1.12-2 2.5-2s2.5.896 2.5 2zm9-2c0 1.105-1.12 2-2.5 2s-2.5-.895-2.5-2 1.12-2 2.5-2 2.5.895 2.5 2z"/>
                                <path fill-rule="evenodd" d="M14 11V2h1v9h-1zM6 3v10H5V3h1z"/>
                                <path d="M5 2.905a1 1 0 0 1 .9-.995l8-.8a1 1 0 0 1 1.1.995V3L5 4V2.905z"/>
                            </svg>
                        </div>
                        <span>Music</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route("search_auctions") }}" class="home-category text-dark" >
                    @csrf
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden disabled>

                    <button class="text-decoration-none" type="submit">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="{{ $cat_svg_size }}" height="{{ $cat_svg_size }}" fill="currentColor"
                                    class="bi bi-book" viewBox="0 0 16 16">
                                <path d="M1 2.828c.885-.37 2.154-.769 3.388-.893 1.33-.134 2.458.063 3.112.752v9.746c-.935-.53-2.12-.603-3.213-.493-1.18.12-2.37.461-3.287.811V2.828zm7.5-.141c.654-.689 1.782-.886 3.112-.752 1.234.124 2.503.523 3.388.893v9.923c-.918-.35-2.107-.692-3.287-.81-1.094-.111-2.278-.039-3.213.492V2.687zM8 1.783C7.015.936 5.587.81 4.287.94c-1.514.153-3.042.672-3.994 1.105A.5.5 0 0 0 0 2.5v11a.5.5 0 0 0 .707.455c.882-.4 2.303-.881 3.68-1.02 1.409-.142 2.59.087 3.223.877a.5.5 0 0 0 .78 0c.633-.79 1.814-1.019 3.222-.877 1.378.139 2.8.62 3.681 1.02A.5.5 0 0 0 16 13.5v-11a.5.5 0 0 0-.293-.455c-.952-.433-2.48-.952-3.994-1.105C10.413.809 8.985.936 8 1.783z"/>
                            </svg>
                        </div>
                        <span>E-Books</span>
                    </button>
                </form>
            </li>
            <li>
                <form action="{{ route("search_auctions") }}" class="home-category text-dark" >
                    @csrf
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden disabled>

                    <button class="text-decoration-none" type="submit">
                        <div>
                            <svg xmlns="http://www.w3.org/2000/svg" width="{{ $cat_svg_size }}" height="{{ $cat_svg_size }}" fill="currentColor"
                                    class="bi bi-grid-1x2-fill" viewBox="0 0 16 16">
                                <path d="M0 1a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v14a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V1zm9 0a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1V1zm0 9a1 1 0 0 1 1-1h5a1 1 0 0 1 1 1v5a1 1 0 0 1-1 1h-5a1 1 0 0 1-1-1v-5z"/>
                            </svg>
                        </div>
                        <span>Comics & Manga</span>
                    </button>
                </form>
            </li>
        </ul>
    </section>


    <div class="py-sm-3 my-4 container">
        @auth
        <div class="row">
            {{-- Recent bids --}}
            <section class="col-xl-6 mt-sm-4">
                <hr class="d-sm-none">
                <span class="d-flex flex-row mb-2 align-items-center">
                                <h4>Recent bids</h4>
                                <a href="search_results.php" class="ms-2 link-secondary text-decoration-none">See all <i
                                        class="bi bi-arrow-right"></i></a>
                            </span>
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                    @each ("partials.auction_card", $bidded_auctions, "auction")
                </div>
            </section>

                {{-- Followed Users' Auctions --}}
                <section class="col-xl-6 mt-sm-4">
                    <hr class="d-sm-none">
                    <span class="d-flex flex-row mb-2 align-items-center">
                    <h4>Followed Users' Auctions</h4>
                    <a href="search_results.php" class="ms-2 text-secondary text-decoration-none">
                        See all <i class="bi bi-arrow-right"></i>
                    </a>
                </span>
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                    @each ("partials.auction_card", $followed_auctions, "auction")
                </div>
            </section>
        </div>
        @endauth

        @if(count($open_auctions))
            {{-- Open Auctions --}}
            <section class="row mt-sm-4 col-lg-12">
                <hr class="d-sm-none">

                <span class="d-flex flex-row mb-2 align-items-center">
                    <h4>Today's auctions</h4>
                    <a href="search_results.php"
                    class="ms-2 link-secondary text-decoration-none align-items-center">
                        See all <i class="bi bi-arrow-right"></i>
                    </a>
                </span>

                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                    @each ("partials.auction_card", $open_auctions, "auction")
                </div>
            </section>
        @else

        @endempty
    </div>
@endsection
