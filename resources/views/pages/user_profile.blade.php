<?php
$current_page = "search_users";
?>

@extends('layouts.app')

@section('content')
    <div class="row m-2">
        {{-- Breadcrumbs --}}
    </div>

    {{-- User Information --}}
    <section class="container">
        <div class="row justify-content-center">
            <div class="d-flex flex-column flex-md-row border border-4">
                <div
                    class="col-12 col-md-8 user-details d-flex flex-column flex-md-row align-items-center align-items-md-start">
                    <div class="profile-avatar m-0 m-md-3">
                        <img width="200" height="200"
                             src="https://i.pinimg.com/originals/1a/7d/32/1a7d32cb2bb09613bd771ac289fbaa7d.jpg"
                             alt="F.F.">
                    </div>

                    <div class="col-12 col-md-4 d-flex flex-column mt-md-5 ps-2 me-2">
                        <h2 class="fw-bold">{{ $user->name }}</h2>

                        <span class="fst-italic mb-2">{{ $user->username }}</span>

                        <button type="button" class="follow btn btn-outline-danger">
                            <i class="bi bi-heart"></i>
                            <span>Follow</span>
                        </button>
                    </div>
                </div>
                <div class="user-details-side d-flex flex-column align-items-md-end ms-2 w-100">
                    <div class="user-actions d-flex flex-row flex-md-column flex-lg-row align-items-end mt-1 mb-2">
                        <!-- OTHERS' PROFILE -->
                        <a class="p-0 link-dark text-decoration-none hover-scale" href="search_results.php">
                            <i class="bi bi-shop"></i>
                            <span>Open Auctions</span>
                        </a>
                        <button type="button" data-bs-toggle="modal" data-bs-target="#report-user-modal"
                                class="btn ms-2 p-0 hover-scale">
                            <i class="bi bi-flag-fill text-danger"></i>
                            <span>Report user</span>
                        </button>
                        <!-- OWN PROFILE -->
                        <!-- <a class="p-0 link-dark text-decoration-none hover-scale" href="settings-account.php">
                            <i class="bi bi-gear"></i>
                            <span>Edit Profile</span>
                        </a> -->
                    </div>
                    <div class="user-description d-flex flex-column-reverse w-100">
                        <a role="button" class="collapsed description-toggler" data-bs-toggle="collapse"
                           href="#user-description" aria-expanded="false" aria-controls="user-description"></a>
                        <p class="collapse mb-1" id="user-description">
                            {{ $user->bio }}
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="container mt-4">
        <div class="row">
            {{-- Feedback --}}
            <section class="col-12 col-md-6">
                <h2 class="fs-bold">Feedback</h2>
                <table id="bid-history" class="table">
                    <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Total</th>
                        <th scope="col">6 months</th>
                        <th scope="col">Last month</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-plus-circle text-success" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path
                                    d="M8 4a.5.5 0 0 1 .5.5v3h3a.5.5 0 0 1 0 1h-3v3a.5.5 0 0 1-1 0v-3h-3a.5.5 0 0 1 0-1h3v-3A.5.5 0 0 1 8 4z"/>
                            </svg>
                        </td>
                        <td>23</td>
                        <td>19</td>
                        <td>3</td>
                    </tr>
                    <tr>
                        <td>
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-dash-circle text-danger" viewBox="0 0 16 16">
                                <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                                <path d="M4 8a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7A.5.5 0 0 1 4 8z"/>
                            </svg>
                        </td>
                        <td>6</td>
                        <td>1</td>
                        <td>1</td>
                    </tr>
                    </tbody>
                </table>
            </section>

            {{-- Insights --}}
            <section class="col col-md-6 d-flex flex-column justify-content-center">
                <h2 class="fs-bold">Insights</h2>

                <div class="container border border-3 p-0">
                    <div class="row p-2 m-0 align-items-center justify-content-center w-100 h-100">
                        <div class="col text-center">
                            <small>Joined</small>
                            <h4>{{ $user->joined }}</h4>
                        </div>
                        <div class="col text-center">
                            <small>Auctions Created</small>
                            <h4>{{ $user->createdAuctions()->count() }}</h4>
                        </div>
                        <div class="col text-center">
                            <small>Followers</small>
                            <h4>{{ $user->followers()->count() }}</h4>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    {{-- Created Auctions --}}
    <section class="container mt-4">
        <h2 class="fs-bold">Created Auctions</h2>
        <div class="d-flex flex-wrap justify-content-center justify-content-sm-start">
            @each("partials.auction_card", $user->createdAuctions()->getResults(), "auction")
        </div>
    </section>

    {{-- Modal --}}
    <section class="modal fade" id="report-user-modal" tabindex="-1" aria-labelledby="report-user-modal-title"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="report-user-modal-title">Report Foo Fighters</h5>
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
@endsection
