@extends('layouts.app', ['current_page' => 'home', 'title' => 'Home'])

@section('content')
    <script src={{ asset("js/auction-card.js") }}></script>

    {{-- Site Banner --}}
    <section id="home-banner" class="mb-5 text-center d-flex flex-column justify-content-between">
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
        <h2 class="pb-1 mb-3 border-bottom">Explore popular categories</h3>

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
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="game" checked hidden>

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
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="sem" checked hidden>

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
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="sftw" checked hidden>

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
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="music" checked hidden>

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
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="book" checked hidden>

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
                    <input class="form-check-input" name="filter_check_category[]" type="checkbox" value="cem" checked hidden>

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


    {{-- Showcased auctions --}}
    <section class="container py-sm-3 my-4">
        @auth
        <div class="row">
            {{-- Recent bids --}}
            <section class="d-flex flex-column col-xl-6 mt-sm-4">
                <hr class="d-sm-none">
                <span class="d-flex flex-row mb-2 align-items-baseline pb-1 mb-3 border-bottom">
                    <h2>Recent bids</h2>
                    <a href="search_results.php" class="ms-2 text-decoration-none text-primary" style="font-size: small;"">
                        See all <i class="bi bi-arrow-right"></i>
                    </a>
                </span>
                @if (count($bidded_auctions))
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                    @each ("partials.auction_card", $bidded_auctions, "auction")
                </div>
                @else
                <div class="d-flex flex-column align-items-center justify-content-center text-muted flex-grow-1">
                    <i class="bi bi-wallet2 display-3"></i>
                    <h5 class="">Bidded auctions will show up here!</h5>
                </div>
                @endif
            </section>

            {{-- Followed Users' Auctions --}}
            <section class="d-flex flex-column col-xl-6 mt-sm-4">
                <hr class="d-sm-none">
                <span class="d-flex flex-row mb-2 align-items-baseline pb-1 mb-3 border-bottom">
                    <h2>Followed Users' Auctions</h2>
                    <a href="search_results.php" class="ms-2 text-decoration-none  text-primary" style="font-size: small;"">
                        See all <i class="bi bi-arrow-right"></i>
                    </a>
                </span>
                @if(count($followed_auctions))
                <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                    @each ("partials.auction_card", $followed_auctions, "auction")
                </div>
                @else
                <div class="d-flex flex-column align-items-center justify-content-center text-muted flex-grow-1">
                    <i class="bi bi-people display-3"></i>
                    <h5 class="">Follow more sellers to track their activity!</h5>
                </div>
                @endif
            </section>
        </div>
        @endauth

        {{-- Open Auctions --}}
        <section class="row mt-sm-4 col-lg-12 py-3">
            <hr class="d-sm-none">

            <span class="d-flex flex-row align-items-baseline pb-1 mb-3 border-bottom">
                <h2>Today's auctions</h2>
                <a href="search_results.php"
                class="ms-2 link-secondary text-decoration-none text-primary" style="font-size: small;">
                    See all <i class="bi bi-arrow-right"></i>
                </a>
            </span>

            @if (count($open_auctions))
            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                @each ("partials.auction_card", $open_auctions, "auction")
            </div>
            @else
            <div class="d-flex flex-column align-items-center justify-content-center text-muted flex-grow-1">
                <i class="bi bi-door-open display-3"></i>
                <h5 class="">Looks like there are no items for sale right now, come back later!</h5>
            </div>
            @endif
        </section>

    </section>


    @guest
    {{-- Join us full width --}}
    <section class="container-fluid d-flex justify-content-center align-items-center bg-primary text-white py-4 my-5">
        <div class="d-flex flex-column align-items-end justify-content-center me-5">
            <h2 class="text-end fw-bold mb-0">Sign up</h2>
            <h4 class="text-end">Start bidding now</h4>
        </div>

        <a class="btn btn-light rounded-3 fs-5 text-primary px-3" role="button" href={{ route('register_form') }}>
            Join us!
        </a>
    </section>
    @endguest

    {{-- Cool site features --}}
    <section class="container px-4 py-5" id="icon-grid">
        <h2 class="pb-2 border-bottom">What we offer</h2>

        <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-4 g-4 py-5">
          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-hammer text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="M9.972 2.508a.5.5 0 0 0-.16-.556l-.178-.129a5.009 5.009 0 0 0-2.076-.783C6.215.862 4.504 1.229 2.84 3.133H1.786a.5.5 0 0 0-.354.147L.146 4.567a.5.5 0 0 0 0 .706l2.571 2.579a.5.5 0 0 0 .708 0l1.286-1.29a.5.5 0 0 0 .146-.353V5.57l8.387 8.873A.5.5 0 0 0 14 14.5l1.5-1.5a.5.5 0 0 0 .017-.689l-9.129-8.63c.747-.456 1.772-.839 3.112-.839a.5.5 0 0 0 .472-.334z"/>
              </svg>
            <div>
              <h4 class="fw-bold mb-0">Sell & Bid</h4>
              <p>I’m willing to see <strong>our transaction</strong> through, are you sir?</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-bookmark-plus text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="M2 2a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v13.5a.5.5 0 0 1-.777.416L8 13.101l-5.223 2.815A.5.5 0 0 1 2 15.5V2zm2-1a1 1 0 0 0-1 1v12.566l4.723-2.482a.5.5 0 0 1 .554 0L13 14.566V2a1 1 0 0 0-1-1H4z"/>
                <path d="M8 4a.5.5 0 0 1 .5.5V6H10a.5.5 0 0 1 0 1H8.5v1.5a.5.5 0 0 1-1 0V7H6a.5.5 0 0 1 0-1h1.5V4.5A.5.5 0 0 1 8 4z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Bookmarks</h4>
              <p>Bookmark auctions to help <strong>keep track</strong> of your activity and interests.</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-heart text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="m8 2.748-.717-.737C5.6.281 2.514.878 1.4 3.053c-.523 1.023-.641 2.5.314 4.385.92 1.815 2.834 3.989 6.286 6.357 3.452-2.368 5.365-4.542 6.286-6.357.955-1.886.838-3.362.314-4.385C13.486.878 10.4.28 8.717 2.01L8 2.748zM8 15C-7.333 4.868 3.279-3.04 7.824 1.143c.06.055.119.112.176.171a3.12 3.12 0 0 1 .176-.17C12.72-3.042 23.333 4.867 8 15z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Follow sellers</h4>
              <p>Simp for your favorite sellers and <strong>get notified of their auctions</strong>.</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-graph-up text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 3.5a.5.5 0 0 1 .5-.5h4a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4.9l-3.613 4.417a.5.5 0 0 1-.74.037L7.06 6.767l-3.656 5.027a.5.5 0 0 1-.808-.588l4-5.5a.5.5 0 0 1 .758-.06l2.609 2.61L13.445 4H10.5a.5.5 0 0 1-.5-.5z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Data availability</h4>
              <p>Detailed <strong>charts</strong> to analyze any auction with ease.</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-envelope text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="M0 4a2 2 0 0 1 2-2h12a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H2a2 2 0 0 1-2-2V4zm2-1a1 1 0 0 0-1 1v.217l7 4.2 7-4.2V4a1 1 0 0 0-1-1H2zm13 2.383-4.758 2.855L15 11.114v-5.73zm-.034 6.878L9.271 8.82 8 9.583 6.728 8.82l-5.694 3.44A1 1 0 0 0 2 13h12a1 1 0 0 0 .966-.739zM1 11.114l4.758-2.876L1 5.383v5.73z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Messaging</h4>
              <p><strong>Communicate with others</strong> for questions, follow-ups and more.</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-hourglass-split text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="M2.5 15a.5.5 0 1 1 0-1h1v-1a4.5 4.5 0 0 1 2.557-4.06c.29-.139.443-.377.443-.59v-.7c0-.213-.154-.451-.443-.59A4.5 4.5 0 0 1 3.5 3V2h-1a.5.5 0 0 1 0-1h11a.5.5 0 0 1 0 1h-1v1a4.5 4.5 0 0 1-2.557 4.06c-.29.139-.443.377-.443.59v.7c0 .213.154.451.443.59A4.5 4.5 0 0 1 12.5 13v1h1a.5.5 0 0 1 0 1h-11zm2-13v1c0 .537.12 1.045.337 1.5h6.326c.216-.455.337-.963.337-1.5V2h-7zm3 6.35c0 .701-.478 1.236-1.011 1.492A3.5 3.5 0 0 0 4.5 13s.866-1.299 3-1.48V8.35zm1 0v3.17c2.134.181 3 1.48 3 1.48a3.5 3.5 0 0 0-1.989-3.158C8.978 9.586 8.5 9.052 8.5 8.351z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Scheduling</h4>
              <p>Want everyone to be ready for your auction? <strong>Schedule it for later</strong>.</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-piggy-bank text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="M5 6.25a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0zm1.138-1.496A6.613 6.613 0 0 1 7.964 4.5c.666 0 1.303.097 1.893.273a.5.5 0 0 0 .286-.958A7.602 7.602 0 0 0 7.964 3.5c-.734 0-1.441.103-2.102.292a.5.5 0 1 0 .276.962z"/>
                <path fill-rule="evenodd" d="M7.964 1.527c-2.977 0-5.571 1.704-6.32 4.125h-.55A1 1 0 0 0 .11 6.824l.254 1.46a1.5 1.5 0 0 0 1.478 1.243h.263c.3.513.688.978 1.145 1.382l-.729 2.477a.5.5 0 0 0 .48.641h2a.5.5 0 0 0 .471-.332l.482-1.351c.635.173 1.31.267 2.011.267.707 0 1.388-.095 2.028-.272l.543 1.372a.5.5 0 0 0 .465.316h2a.5.5 0 0 0 .478-.645l-.761-2.506C13.81 9.895 14.5 8.559 14.5 7.069c0-.145-.007-.29-.02-.431.261-.11.508-.266.705-.444.315.306.815.306.815-.417 0 .223-.5.223-.461-.026a.95.95 0 0 0 .09-.255.7.7 0 0 0-.202-.645.58.58 0 0 0-.707-.098.735.735 0 0 0-.375.562c-.024.243.082.48.32.654a2.112 2.112 0 0 1-.259.153c-.534-2.664-3.284-4.595-6.442-4.595zM2.516 6.26c.455-2.066 2.667-3.733 5.448-3.733 3.146 0 5.536 2.114 5.536 4.542 0 1.254-.624 2.41-1.67 3.248a.5.5 0 0 0-.165.535l.66 2.175h-.985l-.59-1.487a.5.5 0 0 0-.629-.288c-.661.23-1.39.359-2.157.359a6.558 6.558 0 0 1-2.157-.359.5.5 0 0 0-.635.304l-.525 1.471h-.979l.633-2.15a.5.5 0 0 0-.17-.534 4.649 4.649 0 0 1-1.284-1.541.5.5 0 0 0-.446-.275h-.56a.5.5 0 0 1-.492-.414l-.254-1.46h.933a.5.5 0 0 0 .488-.393zm12.621-.857a.565.565 0 0 1-.098.21.704.704 0 0 1-.044-.025c-.146-.09-.157-.175-.152-.223a.236.236 0 0 1 .117-.173c.049-.027.08-.021.113.012a.202.202 0 0 1 .064.199z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Credit system</h4>
              <p><strong>Limited wallets</strong> ensure the <strong>fairness</strong> of our auctions to everyone.</p>
            </div>
          </div>

          <div class="col d-flex align-items-start">
            <svg xmlns="http://www.w3.org/2000/svg" width="1.75em" height="1.75em"
                    class="bi bi-shield-lock text-muted flex-shrink-0 me-3" viewBox="0 0 16 16">
                <path d="M5.338 1.59a61.44 61.44 0 0 0-2.837.856.481.481 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.725 10.725 0 0 0 2.287 2.233c.346.244.652.42.893.533.12.057.218.095.293.118a.55.55 0 0 0 .101.025.615.615 0 0 0 .1-.025c.076-.023.174-.061.294-.118.24-.113.547-.29.893-.533a10.726 10.726 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.775 11.775 0 0 1-2.517 2.453 7.159 7.159 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7.158 7.158 0 0 1-1.048-.625 11.777 11.777 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 62.456 62.456 0 0 1 5.072.56z"/>
                <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415z"/>
            </svg>
            <div>
              <h4 class="fw-bold mb-0">Safe</h4>
              <p>Our platform <strong>safeguards your interests and privacy</strong>.</p>
            </div>
          </div>
        </div>
      </section>


@endsection
