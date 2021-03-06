@extends('layouts.app', ['current_page' => 'users', 'title' => $user->username . ' Profile'])

@section('content')
    {{-- User Information --}}
    <section class="container">
        <div class="row justify-content-center">

            <div class="row px-0 my-2">
                {{-- Breadcrumbs --}}
                @include("partials.breadcrumbs", [
                    "title" => "User Profile",
                    "pages" => [
                        ["title" => "Home", "href" => route('home')],
                        ["title" => "Users", "href" => route('search_users')],
                        ["title" => $user->username, "href" => route('user_profile', ['username' => $user->username])]
                    ]
                ])
            </div>

            <div class="d-flex flex-column flex-md-row border rounded-3" style="border-width: 3px !important;">
                <div class="col-12 col-md-7 col-xl-6 user-details d-flex flex-column flex-md-row align-items-center align-items-md-stretch">
                    <div class="profile-avatar m-0 m-md-3">
                        <img width="200" height="200" @profilepic($user, medium)>
                    </div>

                    <div class="col-12 col-md-5 col-xl-6 d-flex flex-column justify-content-between flex-grow-1 my-md-4 ps-2 me-2">
                        <div>
                            <h2 class="fw-bold">{{ $user->name }}</h2>
                            <span class="fst-italic mb-2">{{ '@' . $user->username }}</span>
                        </div>

                        @if (Auth::check() && Auth::id() != $user->id )
                            <script defer src={{ asset("js/follow_users.js") }}></script>

                            @if (Auth::user()->followsMember($user->id))
                                <button type="button" class="follow btn btn-primary w-100"
                                        member_username="{{ $user->username }}">
                                    <i class="bi bi-heart-fill"></i>
                                    <span>Following</span>
                                </button>
                            @else
                                <button type="button" class="follow btn btn-outline-primary w-100"
                                        member_username="{{ $user->username }}">
                                    <i class="bi bi-heart"></i>
                                    <span>Follow</span>
                                </button>
                            @endif
                        @endif
                    </div>
                </div>

                <div class="user-details-side d-flex flex-column align-items-md-end ms-2 w-100">
                    <div class="user-actions d-flex flex-row flex-md-column flex-lg-row align-items-end mt-1 mb-2">
                        {{-- OTHERS' PROFILE --}}
                        <a class="p-0 link-dark text-decoration-none hover-scale"
                                href="{{ route("search_auctions", ["owner_filter" => "username", "fts_user" => $user->username]) }}">
                            <i class="bi bi-shop"></i>
                            <span>Upcoming Auctions</span>
                        </a>

                        @can('contact', $user)
                            {{-- Contact --}}
                            <button type="button" data-bs-toggle="modal" data-bs-target="#send-message-modal"
                                    class="btn ms-2 p-0 hover-scale">
                                <i class="bi bi-envelope"></i>
                                <span>Contact</span>
                            </button>
                        @endcan

                        @can('report', $user)
                            <button type="button" data-bs-toggle="modal" data-bs-target="#report-user-modal"
                                    class="btn ms-2 p-0 hover-scale">
                                <i class="bi bi-flag"></i>
                                <span>Report user</span>
                            </button>
                        @endcan

                        @can('edit', $user)
                            <a class="p-0 ms-2 link-dark text-decoration-none hover-scale"
                               href={{ route('settings_account') }}>
                                <i class="bi bi-gear"></i>
                                <span>Edit Profile</span>
                            </a>
                        @endcan
                    </div>
                    <div class="user-description d-flex flex-column-reverse w-100">
                        <a role="button" class="collapsed description-toggler text-decoration-none align-self-end"
                           data-bs-toggle="collapse"
                           href="#user-description" aria-expanded="false" aria-controls="user-description"></a>
                        <p class="collapse mb-1" id="user-description">
                            {{ $user->bio ?? $user::$default_bio }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="container mt-4">
        <div class="row">

        {{-- FOLLOWERS --}}
        <section class="col-12 col-md-3 my-3 my-md-0">
            <h2 class="fs-bold position-relative" style="width: min-content">
                Followers
                <span class="position-absolute top-0 start-100 fs-6">({{$user->followedBy()->count()}})</span>
            </h2>
            <hr>

            <ul class="list-unstyled d-flex flex-wrap" style="padding-left: 10px; padding-top: 10px;">
                @if ($user->followedBy()->count() > 0)
                    @foreach ($user->followedBy()->limit(24)->get() as $fol)
                    <li class="hover-scale-big" style="margin-left: -10px; margin-top: -10px; z-index={{$loop->iteration}}">
                        <a href="{{ route("user_profile", [ "username" => $fol->username ]) }}">
                            <img style="border-radius:50%;" width="40" height="40" @profilepic($fol, small)>
                        </a>
                    </li>
                    @endforeach
                @else
                <div class="d-flex flex-column align-items-center justify-content-center text-muted flex-grow-1">
                    <i class="bi bi-people display-5"></i>
                    <h6>No one is following this user</h6>
                </div>
                @endif
            </ul>

        </section>


            {{-- Feedback --}}
            <section class="col-12 col-md-3 my-3 my-md-0">
                <div class="d-flex flex-row align-items-center">
                    <h2 class="fs-bold me-2 mb-0">Feedback</h2>

                    <form action="{{ route("rate_user", [ "username" => $user->username ]) }}" method="post">
                        @csrf

                        @can("rate", $user)
                            @if(Auth::user()->ratedUser($user->id) == 1)
                                <button class="hover-scale btn btn-link p-0" type="submit" name="value"
                                        value="0">
                                    <i class="bi bi-plus-circle-fill text-success"></i>
                                </button>
                            @else
                                <button class="hover-scale btn btn-link p-0" type="submit" name="value"
                                        value="1">
                                    <i class="bi bi-plus-circle text-success"></i>
                                </button>
                            @endif
                        @endcan

                        @can("rate", $user)
                            @if(Auth::user()->ratedUser($user->id) == -1)
                                <button class="hover-scale btn btn-link p-0" type="submit" name="value"
                                        value="0">
                                    <i class="bi bi-dash-circle-fill text-danger"></i>
                                </button>
                            @else
                                <button class="hover-scale btn btn-link p-0" type="submit" name="value"
                                        value="-1">
                                    <i class="bi bi-dash-circle text-danger"></i>
                                </button>
                            @endif
                        @endcan
                    </form>
                </div>
                <hr>

                <div class="d-flex flex-column">
                    <p>
                        <span class="text-muted">Positive rating</span>
                        <span class="float-end">{{ $user->ratings->where("value", 1)->count() }}</span>
                    </p>

                    <p class="pb-2 border-bottom">
                        <span class="text-muted">Negative rating</span>
                        <span class="float-end">- {{ $user->ratings->where("value", -1)->count() }}</span>
                    </p>

                    <p>
                        <span class="text-muted">Total rating</span>
                        <span class="float-end">{{ $user->rating }}</span>
                    </p>
                </div>
            </section>

            {{-- Insights --}}
            <section class="col-12 col-md-6 d-flex flex-column justify-content-start my-3 my-md-0">
                <h2 class="fs-bold">Insights</h2>

                <div class="container border rounded-3 p-0">
                    <div class="row p-2 m-0 align-items-center justify-content-center w-100 h-100">
                        <div class="col text-center">
                            <small>Joined</small>
                            <h4>{{ $user->joined->toFormattedDateString() }}</h4>
                        </div>
                        <div class="col text-center">
                            <small>Auctions Created</small>
                            <h4>{{ $user->createdAuctions()->count() }}</h4>
                        </div>
                        <div class="col text-center">
                            <small>Followers</small>
                            <h4>{{ $user->followedBy()->count() }}</h4>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Created Auctions --}}
    @if ($user->has_auctions)
        <section class="container mt-4 mb-5">
            <h2 class="fs-bold">Created Auctions</h2>
            <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
                @each("partials.auction_card", $user->getProfileAuctions(), "auction")
            </div>
        </section>
    @endif

    {{-- Modals --}}

    {{-- Contact modal --}}
    @can('contact', $user)
        <section class="modal fade" id="send-message-modal" tabindex="-1" aria-labelledby="send-message-modal-title"
                 aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="send-message-modal-title">
                            Contact {{ $user->name }}
                        </h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <form id="contact-user-form" method="post" action="{{ route('create_message_thread') }}">
                        @csrf

                        <input hidden name="user_id" value="{{ $user->id }}">

                        <div class="modal-body">
                            <p class="my-0">Are you sure you want to start a new thread with
                                @<strong>{{ $user->username }}</strong>?</p>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Confirm</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endcan


    @can('report', $user)
        <section class="modal fade" id="report-user-modal" tabindex="-1" aria-labelledby="report-user-modal-title"
                 aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="report-user-modal-title">Report {{ $user->name }}</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form>
                        <div class="modal-body">
                            <label for="inputCategory" class="fw-bold">Reason</label>
                            <div class="mb-3">
                                <select class="form-select" id="inputCategory">
                                    <option selected>Choose...</option>
                                    <option value="1">Fraud</option>
                                    <option value="2">Improper profile image</option>
                                    <option value="3">Improper username</option>
                                    <option value="4">Other</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="report-reason" class="form-label fw-bold">Description</label>
                                <textarea class="form-control" id="report-reason" rows="6"></textarea>
                                <span class="input-group-text text-wrap">Elaborate the reason to report this user, so we can analyze the case better.</span>

                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-danger">Report</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endcan
@endsection
