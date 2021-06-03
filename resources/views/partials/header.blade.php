<header class="navbar navbar-expand-md navbar-dark bg-dark py-2">
    {{-- Main Navigation Bar --}}
    <nav class="container-fluid flex-wrap align-items-center flex-md-nowrap mx-0" aria-label="Main Navigation">
        <a class="navbar-brand d-flex align-items-center p-0 me-md-3 mx-auto" aria-label="Trade-a-Bid" href="/">
            <img class="me-1" src={{ asset('images/logo.svg') }} width="40" height="40" alt="Trade-a-Bid">
            <span class="fs-4">Trade-a-Bid</span>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#siteHeader"
                aria-controls="siteHeader" aria-expanded="false" aria-label="Toggle Navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse ps-2 ps-md-0" id="siteHeader">
            <ul class="row navbar-nav flex-row flex-wrap m-0 p-0 mt-2 mt-md-0 pt-2 pt-md-0">

                {{-- Navigation Anchors --}}
                @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "home", "title" => "Home", "route" => "home"])
                @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "auctions", "title" => "Auctions", "route" => "search_auctions"])
                @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "users", "title" => "Users", "route" => "search_users"])

                @includeWhen(!Auth::guard('admin')->check(), "partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "create_auction", "title" => "Sell Item", "route" => "create_auction"])
            </ul>

            <hr class="d-md-none text-white-50">

            <ul class="navbar-nav flex-row ms-md-auto me-md-1">
                @auth
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
                    <li class="d-none d-md-flex nav-item dropdown px-1" id="user-data"
                        data-username="{{ Auth::user()->username }}" data-name="{{ Auth::user()->name }}" data-id="{{ Auth::user()->id }}">
                        <button class="btn btn-dark dropdown-toggle d-flex flex-row align-items-center" type="button"
                                id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            <span class="me-2">{{ Auth::user()->name }}</span>
                            <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                <img style="border-radius:50%;" width="40" height="40" @profilepic(Auth::user(), small)>
                            </div>
                        </button>

                        {{-- Dropdown menu --}}
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                            <li><a class="dropdown-item" href={{ route('dashboard') }}>Dashboard</a></li>
                            <li><a class="dropdown-item" href={{ route('inbox') }}>Messages</a></li>
                            <li>
                                <a class="dropdown-item" href={{ route('user_profile', ['username' => 'me']) }}>
                                    Profile
                                </a>
                            </li>
                            <li><a class="dropdown-item" href={{ route('settings') }}>Settings</a></li>
                            <li><a class="dropdown-item" href={{ route('logout') }}>Sign out</a></li>
                        </ul>
                    </li>

                         {{-- Dropdown menu --}}
                         <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                            <li><a class="dropdown-item" href={{ route('dashboard') }}>Dashboard</a></li>
                            <li><a class="dropdown-item" href={{ route('inbox') }}>Messages</a></li>
                            <li>
                                <a class="dropdown-item" href={{ route('user_profile', ['username' => 'me']) }}>
                                    Profile
                                </a>
                            </li>
                            <li><a class="dropdown-item" href={{ route('settings') }}>Settings</a></li>
                            <li><a class="dropdown-item" href={{ route('logout') }}>Sign out</a></li>
                        </ul>
                    </li>

                    {{-- Dropdown Menu --}}
                    <div class="d-flex d-md-none flex-wrap flex-row w-100">
                        <li class="nav-item col-12 d-flex justify-content-between">
                            <div class="col-6 d-flex align-items-center">
                                <div class="d-flex p-0 align-self-center align-items-center" style="width: 32px; height: 32px;">
                                    <img style="border-radius:50%;" width="30" height="30" @profilepic(Auth::user(), small)>
                                </div>
                                <span class="ms-1 navbar-text">{{ Auth::user()->name }}</span>
                            </div>
                            <button class="col-6 btn hover-scale d-flex align-items-center p-0" type="button"
                                    data-bs-toggle="modal" data-bs-target="#notifications-modal">
                                <span class="navbar-text"><i
                                        class="bi bi-bell text-muted"></i> Notifications (42)</span>
                            </button>

                            {{-- Dropdown menu --}}
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href={{ route('admin.user_management') }}>Dashboard</a></li>
                                <li><a class="dropdown-item" href={{ route('admin.logout') }}>Sign out</a></li>
                            </ul>
                        </li>

                        <li class="nav-item col-6"><a class="nav-link" href={{ route('settings') }}>Settings</a></li>
                        <li class="nav-item col-6"><a class="nav-link"
                                                      href={{ route('user_profile', ['username' => 'me']) }}>Profile</a>
                        </li>
                        <li class="nav-item col-6"><a class="nav-link" href={{ route('inbox') }}>Messages</a></li>
                        <li class="nav-item col-6"><a class="nav-link" href={{ route('dashboard') }}>Dashboard</a></li>
                        <li class="nav-item col-6"><a class="nav-link" href="">Sign out</a></li>
                    </div>
                @else
                    @admin
                        {{-- Admin logged-in --}}
                        <li class="d-none d-md-flex nav-item dropdown px-1">
                            <button class="btn btn-dark dropdown-toggle d-flex flex-row align-items-center" type="button"
                                    id="user-dropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <span class="me-2">{{ Auth::guard('admin')->user()->username }}</span>
                                <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                    <img style="border-radius:50%;" width="40" height="40" @profilepic(Auth::guard('admin')->user(), small)>
                                </div>
                            </button>

                            {{-- Dropdown menu --}}
                            <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                                <li><a class="dropdown-item" href={{ route('admin.user_management') }}>Dashboard</a></li>
                                <li><a class="dropdown-item" href={{ route('admin.logout') }}>Sign out</a></li>
                            </ul>
                        </li>
                    @else
                        {{-- User not logged in --}}
                        <li class="nav-item btn btn-dark col-6 col-md-auto me-2 border border-secondary rounded-3 py-0 px-2" style="box-sizing: content-box;">
                            <a class="nav-link" href={{ route('login_form') }}>Sign in</a>
                        </li>

                        <li class="nav-item btn btn-primary col-6 col-md-auto py-0 px-2" style="box-sizing: content-box;">
                            <a class="nav-link rounded-3"
                            href={{ route('register_form') }}>
                                Sign up
                            </a>
                        </li>
                    @endadmin
                @endauth
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
