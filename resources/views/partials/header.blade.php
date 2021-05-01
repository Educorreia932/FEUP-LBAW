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
                @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "home", "title" => "Home"])

                {{-- Navigation Anchors --}}
                <section class="d-flex p-0 col-6 col-md-auto flex-column flex-md-row" id="headerAuctionSection">
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "search_auctions", "title" => "Auctions"])
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "search_users", "title" => "Users"])
                    @include("partials.navigation_anchor", [ "current_page" => $current_page, "page_name" => "create_auction", "title" => "Sell Item"])
                </section>
            </ul>

            <hr class="d-md-none text-white-50">

            <ul class="navbar-nav flex-row ms-md-auto me-md-4">
                @if ($user)
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
                            <span class="me-2">{{ $user->username }}</span>
                            <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                                <img style="border-radius:50%;" width="40" height="40"
                                     src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg"
                                     alt="Profile Image">
                            </div>
                        </button>

                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="user-dropdown">
                            <li><a class="dropdown-item" href={{ route('dashboard') }}>Dashboard</a></li>
                            <li><a class="dropdown-item"
                                   href={{ route('user_profile', ['username' => 'me']) }}>Profile</a>
                            </li>
                            <li><a class="dropdown-item" href={{ route('settings') }}>Settings</a></li>
                            <li><a class="dropdown-item" href={{ route('logout') }}>Sign out</a></li>
                        </ul>
                    </li>

                    {{-- Dropdown Menu --}}
                    <div class="d-flex d-md-none flex-wrap flex-row w-100">
                        <li class="nav-item col-12 d-flex justify-content-between">
                            <div class="col-6 d-flex align-items-center">
                                <div class="d-flex p-0 align-self-center" style="width: 32px; height: 32px;">
                                    <img style="border-radius:50%;" width="32" height="32"
                                         src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg"
                                         alt="Profile Image">
                                </div>
                                <span class="ms-1 navbar-text">Educorreia932</span>
                            </div>
                            <button class="col-6 btn hover-scale d-flex align-items-center p-0" type="button"
                                    data-bs-toggle="modal" data-bs-target="#notifications-modal">
                                <span class="navbar-text"><i
                                        class="bi bi-bell text-muted"></i> Notifications (42)</span>
                            </button>
                        </li>
                        <li class="nav-item col-6"><a class="nav-link" href={{ route('settings') }}>Settings</a></li>
                        <li class="nav-item col-6"><a class="nav-link"
                                                      href={{ route('user_profile', ['username' => 'me']) }}>Profile</a>
                        </li>
                        <li class="nav-item col-6"><a class="nav-link" href="">Sign out</a></li>
                        <li class="nav-item col-6"><a class="nav-link" href={{ route('dashboard') }}>Dashboard</a></li>
                    </div>

                @else
                    {{-- Authentication --}}
                    <li class="nav-item col-6 col-md-auto">
                        <a class="nav-link px-2" href="login">Sign in</a>
                    </li>

                    <li class="nav-item col-6 col-md-auto">
                        <a class="d-inline-block d-md-block nav-link border border-white rounded-3 px-2"
                           href="register">
                            Sign up
                        </a>
                    </li>
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
