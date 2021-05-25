@extends('layouts.app', ['current_page' => 'auctions', 'title' => $auction->title])

@section('content')

@inject('helper', \App\Helpers\LbawUtils::class)

<script defer src={{ asset("js/auction.js") }}></script>

@auth
<script defer src={{ asset("js/bookmark.js") }}></script>
@endauth

<div class="row m-2">
    {{-- Page header --}}
    @include("partials.breadcrumbs", [
        "title" => "Auction",
        "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Auctions", "href" => route('search_auctions')],
            ["title" => $auction->title, "href" => route('auction', ['id' => $auction->id])]
        ]
    ])
</div>

<section class="container-fluid bg-light">
    <div class="row">
        {{-- Product images --}}
        <div id="product-images" class="carousel slide col-md-5" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#product-images" data-bs-slide-to="0" class="active"
                        aria-current="true" aria-label="Thumbnail"></button>
                @foreach ($auction->genImages('medium') as $img)
                <button type="button" data-bs-target="#product-images" data-bs-slide-to="{{$loop->iteration}}"
                        aria-label="Image {{$loop->iteration}}"></button>
                @endforeach
            </div>

            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img class="d-block m-auto"
                            src={{ $auction->getThumbnail('medium') }}
                            alt="Auction Thumbnail">
                </div>

                @foreach ($auction->genImages('medium') as $img)
                <div class="carousel-item">
                    <img class="d-block m-auto"
                            src={{$img}}
                            alt="Auction image">
                </div>
                @endforeach
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#product-images"
                    data-bs-slide="prev">
                <span class="carousel-control-prev-icon handle-background" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#product-images"
                    data-bs-slide="next">
                <span class="carousel-control-next-icon handle-background" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>

        {{-- Auction information --}}
        <div id="auction-information" class="col-md my-4 d-flex flex-column justify-content-between">
            {{-- Product information --}}
            <div class="row" id="product-information">
                <div class="row">
                    <h2 class="col mb-0 d-flex order-2 order-sm-1 order-md-2 order-lg-1 align-items-center">
                        <i class="bi bi-circle-fill me-2
                            @if ($auction->ended or $auction->interrupted) text-danger @elseif ($auction->scheduled) text-warning @elseif($auction->open) text-success @endif"
                            style="font-size: 0.5em;"></i>
                        {{$auction->title}}
                    </h2>
                    <div
                        class="p-0 justify-content-center justify-content-sm-end justify-content-md-start justify-content-lg-end col-12 col-sm-4 col-md-12 col-lg-4 order-1 order-sm-2 order-md-1 order-lg-2 d-flex">
                        @can('report', $auction)
                        {{-- button for reporting auction --}}
                        <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                                data-bs-target="#report-modal">
                            <i class="bi bi-flag-fill text-danger" style="font-size:1.5em;"></i>
                            <span>Report auction</span>
                        </button>
                        @endcan

                        @can('edit', $auction)
                        {{-- button for editing auction information --}}
                        <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                                data-bs-target="#edit-modal">
                            <i class="bi bi-pencil" style="font-size: 1.5em; text-align: right"></i>
                        </button>
                        @endcan

                        @auth
                        {{-- button for bookmarking auction --}}
                        <button type="button" class="btn hover-scale auction-bookmark" auction_id="{{ $auction->id }}">
                            <i class="bi @if (Auth::user()->bookmarkedAuction($auction->id)) bi-bookmark-dash-fill @else bi-bookmark-plus @endif"
                                style="font-size: 1.5em; text-align: right"></i>
                        </button>
                        @endauth
                    </div>

                </div>
                <p class="text-muted">{{ $auction->category }}</p>
                <p class="text-overflow-ellipsis">{{$auction->description}}</p>
            </div>

            <div class="row">
                <div
                    class="col-sm-4 col-xl-6 order-sm-2 d-flex flex-column align-items-sm-end justify-content-sm-end mb-4 mb-sm-0 ml-1">
                    <h3 class="d-sm-none">Seller</h3>
                    <h5 class="d-none d-sm-block text-muted">Seller</h5>
                    <a href={{route('user_profile', ['username' => $auction->seller->username])}}
                        class="text-decoration-none link-dark d-flex align-items-center flex-row-reverse justify-content-end flex-sm-row justify-content-sm-start">
                        <span class="ms-3 ms-sm-0 me-0 me-sm-3">{{$auction->seller->name}}</span>
                        <div class="d-flex p-0 align-self-center" style="width: 40px; height: 40px;">
                            <img style="border-radius:50%;" width="40" height="40" @profilepic($auction->seller, small)>
                        </div>
                    </a>
                </div>

                <div class="col-sm-8 col-xl-6 order-sm-1">
                    @if ($auction->ended)
                        {{-- AUCTION ENDED --}}
                        <h3>Winning Bid</h3>
                        <div class="row">
                            <div class="col d-flex flex-column">
                                @if ($auction->current_bid != null)
                                <h4>@currency($auction->current_bid) &phi;</h4>
                                @else
                                <h4>No bids were made</h4>
                                @endif
                            </div>
                        </div>
                    @elseif ($auction->scheduled)
                        {{-- AUCTION IS OPEN --}}
                        <h3>Starts in</h3>
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <h4>{{ $auction->start_date->longAbsoluteDiffForHumans() }}</h4>
                            </div>
                        </div>
                    @else
                        {{-- AUCTION IS OPEN --}}
                        <h3>Bids</h3>
                        <div class="row">
                            <div class="col d-flex flex-column">
                                <span>Current bid</span>
                                @if ($auction->current_bid != null)
                                <h4>@currency($auction->current_bid) &phi;</h4>
                                @else
                                <h4>No bids</h4>
                                @endif
                            </div>
                            <div class="col d-flex flex-column">
                                <span>Next bid starts at</span>
                                <h4>@currency($auction->next_bid) &phi;</h4>
                            </div>
                        </div>

                        @guest
                            @admin
                                {{-- When admin is loged in --}}
                            @else
                                <a class="row mt-2" href="{{ route('login') }}">
                                    <button type="button" class="btn btn-primary offset-2 col-6" aria-label="Login to bid">Login to Bid</button>
                                </a>
                            @endadmin
                        @else
                            @if($auction->holdsLatestBid(Auth::id()) && $auction->seller_id != Auth::id())
                                <h5><strong>You hold the lastest bid</strong></h5>
                            @else
                                @can('bid', $auction)
                                <form action="{{ route('auction_bid', ['id' => $auction->id]) }}" method="POST">

                                    @csrf

                                    <div class="input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text">&phi;</span>
                                        </div>
                                        <input required type="number" name="bid" class="form-control hide-appearence" placeholder="Enter bid" step=0.01 min={{ number_format($auction->next_bid / 100, 2) }}>
                                        <input type="submit" class="btn bg-primary text-light" value="Bid" type="button" role="button">
                                    </div>
                                </form>
                                @endcan
                            @endif
                        @endguest
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Auction details --}}
<section class="container-fluid p-4">
    <div class="row">
        <span class="d-flex align-items-end">
            <h3 class="m-0 p-0">Auction Details</h3>
        </span>
        <hr class="my-1">

        @if (!$auction->ended)
            @include("partials.auction_detail", ["key" => "Closes", "value" => $auction->end_date->diffForHumans(), "subgroup" => false])
        @endif
        @include("partials.auction_detail", ["key" => "Duration", "value" => $auction->end_date->longAbsoluteDiffForHumans($auction->start_date), "subgroup" => false])
        @include("partials.auction_detail", ["key" => "Start Date", "value" => $auction->start_date, "subgroup" => false])
        @include("partials.auction_detail", ["key" => "End Date", "value" => $auction->end_date, "subgroup" => false])
        @include("partials.auction_detail", ["key" => "Bidders", "value" => $auction->n_bidders . " different bidders", "subgroup" => true])
        @include("partials.auction_detail", ["key" => "Total Bids", "value" => $auction->n_bids . " bids", "subgroup" => false])
        @include("partials.auction_detail", ["key" => "Starting Bid", "value" => $helper->formatCurrency($auction->starting_bid) . " φ", "subgroup" => true])
        @include("partials.auction_detail", ["key" => "Bid Increment", "value" => $auction->getIncrementString(), "subgroup" => false])
    </div>
</section>

{{-- Bid history --}}
@if ($auction->has_bids)
<section class="container-fluid p-4">

    <!-- Chart.JS -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js" crossorigin="anonymous"></script>

    <div class="row d-flex flex-row">
        <span class="d-flex align-items-end">
            <h3 class="m-0 p-0">Bid History</h3>
            <a class="ms-3 text-decoration-none" style="font-size: smaller;" href={{route('auction_details', ['id' => $auction->id])}}>
                <i class="bi bi-box-arrow-right"></i> See full history
            </a>
        </span>

        <hr class="my-1">

        @php
            $bid_list = $auction->bids()->orderBy('date', 'desc')->limit(6)->get();
        @endphp

        {{-- Data for chart.js --}}
        <ol id="chart-data" style="display: none;">
            @foreach ($bid_list as $bid)
            <li bid_value={{ $bid->value }} bid_timestamp="{{ $bid->date->timestamp }}"></li>
            @endforeach
        </ol>

        {{-- Bid history chart --}}
        <div class="row col-lg-7 order-lg-2 d-flex flex-column justify-content-center">
            <canvas class="mt-4" id="bid-history-chart"></canvas>
        </div>

        {{-- Bid history table --}}
        <div class="row col-lg-5 order-lg-1">
            <table id="bid-history" class="table table-striped table-hover" style="height: min-content;">
                <thead>
                <tr>
                    <th scope="col">Bidder</th>
                    <th scope="col">Bid</th>
                    <th scope="col">Date</th>
                </tr>
                </thead>
                <tbody>
                    @foreach ($bid_list as $bid)
                        @include("partials.bid_table_entry", ["auction" => $auction, "bid_id" => $bid->id, "value" => $bid->value, "time" => $bid->date->diffForHumans()])
                    @endforeach

                    @if ($auction->n_bids != count($bid_list))
                    <tr>
                        <td></td>
                        <td>...</td>
                        <td></td>
                    </tr>
                    @endif

                    <tfoot>
                        <td>Starting Bid</td>

                        <td>{{ $helper->formatCurrency($auction->starting_bid) }} &phi;</td>
                        <td>{{ $auction->start_date->diffForHumans() }}</td>
                    </tfoot>
                </tbody>
            </table>
        </div>
    </div>
</section>
@endif


@can('report', $auction)
{{-- Report modal --}}
<section class="modal fade" tabindex="-1" role="dialog" id="report-modal">
    <form id="report-form" class="modal-dialog modal-dialog-centered" method="post"
            action="{{ route("auction_report", [ "id" => $auction->id ]) }}">
        @csrf

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Report auction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div class="mb-3">
                    <select name="reason" class="form-select" form="report-form">
                        <option selected>Choose...</option>
                        <option value="Fraudalent Auction">Fraudaulent auction</option>
                        <option value="Improper product pictures">Improper product pictures</option>
                        <option value="Improper auction title">Improper auction title</option>
                        <option value="Other">Other</option>
                    </select>
                </div>

                <div class="mb-3">
                <textarea class="form-control" id="report-description" rows="6" name="description"
                            form="report-form"></textarea>
                    <span class="input-group-text text-wrap">Elaborate the reason to report this auction, so we can analyze the case better.</span>
                </div>
            </div>

            <input hidden name="reporter_id" value={{ Auth::id() }}>

            <div class="modal-footer">
                <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
                <button class="btn btn-danger" type="submit">Report</button>
            </div>
        </div>
    </form>
</section>
@endcan


@can('edit', $auction)
{{-- Edit modal --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modalLable" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="edit-form" method="post"
              action="{{ route("auction_edit", [ "id" => $auction->id ]) }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="modalLable">Edit Auction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <div>

                    <div class="row">
                        {{-- Auction name --}}
                        <div class="form-group col-md-12 mt-3">
                            <label for="inputName" class="sr-only">Auction Name</label>
                            <input type="text" id="inputName" value="{{ $auction->title }}" class="form-control"
                                   name="title">
                        </div>

                        {{-- Auction description --}}
                        <div class="form-group col-md-12 mt-3">
                            <label for="inputDescription" class="sr-only">Auction Description</label>
                            <textarea class="form-control" rows="4"
                                      id="inputDescription" name="description">{{ $auction->description }}</textarea>
                        </div>

                        {{-- Starting on --}}
                        <div class="form-group col-sm-12 mt-3">
                            <label for="startDate" class="sr-only">Starting on</label>
                            <div class="input-group">
                                <input type="date" id="startDate" class="form-control"
                                       name="start_date" value={{ $auction->start_date->format('Y-m-d') }}>
                                <input type="time" id="startTime" class="form-control"
                                       name="start_time" value="{{ $auction->start_date->format('H:i') }}">
                            </div>
                        </div>

                        {{-- Ending on --}}
                        <div class="form-group col-sm-12 mt-3">
                            <label for="endDate" class="sr-only">Ending on</label>
                            <div class="input-group">
                                <input type="date" id="endDate" class="form-control" name="end_date"
                                       value={{ $auction->end_date->format('Y-m-d') }}>
                                <input type="time" id="endTime" class="form-control" name="end_time"
                                       value="{{ $auction->end_date->format('H:i') }}">
                            </div>
                        </div>

                        {{-- Starting bid --}}
                        <div class="form-group col-sm-6 mt-3">
                            <label for="inputValue" class="sr-only">Starting Bid</label>
                            <div class="input-group">
                                <input type="text" id="inputValue" class="form-control" placeholder="0.00"
                                       aria-label="Euro amount (with dot and two decimal places)"
                                       name="starting_bid" value={{ $auction->starting_bid }}>
                                <span class="input-group-text">&phi;</span>
                            </div>
                        </div>

                        {{-- Increment --}}
                        <div class="form-group col-sm-6 mt-3">
                            <label for="inputIncr" class="sr-only">Increment</label>
                            <div class="input-group">
                                <input type="text" id="inputIncr" class="form-control" placeholder="0.00"
                                       aria-label="Phi amount (with dot and two decimal places)"
                                       name="increment" value={{ $auction->increment_fixed }}>
                                <span class="input-group-text">&phi;</span>
                            </div>
                        </div>

                        <div class="d-flex flex-row mt-3">
                            {{-- Category --}}
                            <div class="col-sm-6">
                                <label for="inputCategory">Category</label>
                                <div class="input-group mb-3 col-sm-6">
                                    <select class="form-select" id="inputCategory" form="edit-form"
                                            name="category">f
                                        <option selected>Choose...</option>
                                        <option
                                            value="Games" {{ $auction->category == 'Games' ? "selected" : "" }}>
                                            Games
                                        </option>
                                        <option
                                            value="Software" {{ $auction->category == 'Software' ? "selected" : "" }}>
                                            Software
                                        </option>
                                        <option
                                            value="E-Books" {{ $auction->category == 'E-Books' ? "selected" : "" }}>
                                            eBook
                                        </option>
                                        <option
                                            value="Music" {{ $auction->category == 'Music' ? "selected" : "" }}>
                                            Music
                                        </option>
                                        <option
                                            value="Skins" {{ $auction->category == 'Skins' ? "selected" : "" }}>
                                            Skins
                                        </option>
                                        <option
                                            value="Other" {{ $auction->category == 'Other' ? "selected" : "" }}>
                                            Other
                                        </option>
                                    </select>
                                </div>
                            </div>

                            {{-- NSFW --}}
                            <div class="ms-3 mt-4 form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="switch-nsfw"
                                       name="nsfw" value={{ $auction->nsfw }}>
                                <label class="form-check-label" for="switch-nsfw">NSFW</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>
@endcan


@endsection

