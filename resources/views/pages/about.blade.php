@extends('layouts.app')

@section('content')
    <div class="container-fluid" style="flex:auto;">
        <div class="row bg-light-grey">
            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center text-center">
                <figure>
                    <blockquote class="blockquote">
                        <p>It's a website.</p>
                    </blockquote>
                    <figcaption class="blockquote-footer">
                        João Correia Lopes & Sérgio Nunes in <cite title="Source Title">LBAW</cite>
                    </figcaption>
                </figure>
            </div>

            <div class="col-md-8 px-0">
                <img class="img-fluid" style="max-height: 30em;" src={{ "images/lbaw.png" }} alt="...">
            </div>
        </div>

        <section class="row my-4 justify-content-center">
            <div class="col-md-10 col-lg-8 col-xl-10">
                <div class="text-center">
                    <h3>Celebrating over 3 weeks in development!</h3>
                </div>

                <div class="text-start">
                    <p>Currently, most websites that provide auction services focus on physical items that must be
                        transported from the seller to the buyer, which entails various complications such as creating
                        false addresses to bypass shipping costs and using built-in or third-party messaging
                        applications to transfer the item bought.</p>
                    <p>Therefore we offer a unique web platform to auction exclusively digital products.</p>
                </div>
            </div>
        </section>

        <div class="row my-4 bg-light-grey">
            <div class="col-md-8 px-0">
                <img class="img-fluid" style="max-height: 30em;" src={{ asset('images/lbaw_offices.png') }} alt="...">
            </div>

            <div class="col-md-4 d-flex flex-column align-items-center justify-content-center text-center">
                <h3>Our offices</h3>
                <p>Come meet us at our offices in <span style="text-decoration: line-through;">redacted</span>!</p>
            </div>
        </div>

        {{-- Statistics --}}
        <section class="row m-4">
            <h3>Statistics</h3>

            <div class="container-fluid">
                <div class="row">
                    <div class="ps-4 ps-md-0 col-md-5 text-md-center">
                        <h5>Total Auctions</h5>
                        <h6>613 484</h6>
                    </div>
                </div>
                <div class="row justify-content-md-center">
                    <div class="ps-4 ps-md-0 col-md-5 text-md-center">
                        <h5>Registered Losers</h5>
                        <h6>84 371</h6>
                    </div>
                </div>
                <div class="row justify-content-md-end">
                    <div class="ps-4 ps-md-0 col-md-5 text-md-center">
                        <h5>Brain Cells Lost</h5>
                        <h6>100 %</h6>
                    </div>
                </div>
            </div>
        </section>

        {{-- Team --}}
        <section class="row m-4">
            <h3>Meet our Team</h3>

            <div class="d-flex flex-row align-items-stretch justify-content-between overflow-auto">
                @include("partials.team_card", ["name" => "Eduardo Correia", "username" => "Educorreia932", "img" => asset("images/team/skelizard.png")])
                @include("partials.team_card", ["name" => "Ivo Saavedra", "username" => "ivSaav", "img" => asset("images/team/i_haz_bucket.png")])
                @include("partials.team_card", ["name" => "Telmo Baptista", "username" => "Telmooo", "img" => asset("images/team/toilmo.png")])
                @include("partials.team_card", ["name" => "Tiago Silva", "username" => "tiagodusilva", "img" => asset("images/team/homelessBanjoGuy.png")])
            </div>
        </section>
    </div>
@endsection
