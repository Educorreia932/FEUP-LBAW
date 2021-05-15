<header class="navbar navbar-expand-md navbar-dark bg-dark py-2">
    {{-- Main Navigation Bar --}}
    <nav class="container-fluid flex-wrap flex-md-nowrap mx-0" aria-label="Main Navigation">
        <a class="navbar-brand p-0 me-md-3 mx-auto fs-4" aria-label="Trade-a-Bid" href="/">
            <img src={{ asset('images/logo.svg') }} width="60" height="60" alt="Trade-a-Bid">
            <span>Trade-a-Bid</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteHeader"
                aria-controls="siteHeader" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse ps-2 ps-md-0" id="siteHeader">
            <ul class="container-fluid navbar-nav flex-row flex-wrap m-0 p-0 mt-2 mt-md-0 pt-2 pt-md-0">
                @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "home", "title" => "Home", "route" => "home"])

                {{-- Navigation Anchors --}}
                <section class="d-flex p-0 col-6 col-md-auto flex-column flex-md-row" id="headerAuctionSection">
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "auctions", "title" => "Auctions", "route" => "search_auctions"])
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "users", "title" => "Users", "route" => "search_users"])
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "create_auction", "title" => "Sell Item", "route" => "create_auction"])


                    @admin
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "user_management", "title" => "Dashboard", "route" => "admin.user_management"])
                    @endadmin
                </section>
            </ul>

            <hr class="d-md-none text-white-50">

            <ul class="navbar-nav flex-row ms-md-auto me-md-4">
                @if (Auth::check())
                    {{-- Notifications --}}
                    <button class="d-none d-md-block btn hover-scale position-relative align-middle me-2 px-4"
                            type="button"
                            data-bs-toggle="modal" data-bs-target="#notifications-modal">
                        <i class="bi bi-bell position-absolute top-50 start-50 translate-middle text-center text-white"
                           style="font-size:xx-large;"></i>
                        <span class="position-absolute top-50 start-50 translate-middle text-center text-white"
                              style="font-size:small; font-weight: bold;">42</span>
                    </button>

                    {{-- Logged-in User --}}
                    <li class="d-none d-md-flex nav-item dropdown px-1">
                        <button class="btn btn-dark dropdown-toggle d-flex flex-row align-items-center" type="button"
                                id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">{{ Auth::user()->name }}</span>
                            <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                <img style="border-radius:50%;" width="40" height="40"
                                     src={{ Auth::user()->getImage('small') }}
                                     alt="Profile Image">
                            </div>
                        </button>

                        {{-- Dropdown menu --}}
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                            <li><a class="dropdown-item" href={{ route('dashboard') }}>Dashboard</a></li>
                            <li><a class="dropdown-item"
                                   href={{ route('user_profile', ['username' => 'me']) }}>Profile</a>
                            </li>
                            <li><a class="dropdown-item" href={{ route('settings') }}>Settings</a></li>
                            <li><a class="dropdown-item" href={{ route('logout') }}>Sign out</a></li>
                        </ul>
                    </li>


                @else

                    {{-- Admin logged-in --}}
                    @if (Auth::guard('admin')->check()) 
                        <button class="d-none d-md-block btn hover-scale position-relative align-middle me-2 px-4"
                                type="button"
                                data-bs-toggle="modal" data-bs-target="#notifications-modal">
                            <i class="bi bi-bell position-absolute top-50 start-50 translate-middle text-center text-white"
                            style="font-size:xx-large;"></i>
                            <span class="position-absolute top-50 start-50 translate-middle text-center text-white"
                                style="font-size:small; font-weight: bold;">42</span>
                        </button>

                        {{-- Logged-in User --}}
                        <li class="d-none d-md-flex nav-item dropdown px-1">
                            <button class="btn btn-dark dropdown-toggle d-flex flex-row align-items-center" type="button"
                                    id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2">{{ Auth::guard('admin')->user()->username }}</span>
                                <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                    <img style="border-radius:50%;" width="40" height="40"
                                        src={{ Auth::guard('admin')->user()->getImage('small') }}
                                        alt="Profile Image">
                                </div>
                            </button>

                            {{-- Dropdown menu --}}
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href={{ route('admin.user_management') }}>Dashboard</a></li>
                                <li><a class="dropdown-item" href={{ route('admin.logout') }}>Sign out</a></li>
                            </ul>
                        </li>
                    
                    @else 
                        {{-- Authentication --}}
                        <li class="nav-item col-6 col-md-auto">
                            <a class="nav-link px-2" href={{ route('login_form') }}>Sign in</a>
                        </li>

                        <li class="nav-item col-6 col-md-auto">
                            <a class="d-inline-block d-md-block nav-link border border-white rounded-3 px-2"
                            href={{ route('register_form') }}>
                                Sign up
                            </a>
                        </li>
                    @endif
                @endif
            </ul>
        </div>
    </nav>

    {{-- Notifications Modal --}}
    <section class="modal fade" tabindex="-1" role="dialog" id="notifications-modal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Notifications</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">

                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">View All</button>
                </div>
            </div>
        </div>
    </section>
</header>
