@extends('layouts.app', ['current_page' => 'auctions', 'title' => $auction->title])

@section('content')

<script defer src={{ asset("js/auction.js") }}></script>
<script defer src={{ asset("js/init_tooltips.js") }}></script>

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
                        @auctionStatus($auction)
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
                @empty($auction->description)
                    <p class="text-muted text-overflow-ellipsis">No description was given for this item</p>
                @else
                    <p class="text-overflow-ellipsis">{{$auction->description}}</p>
                @endempty
            </div>

            <div class="row">
                <div
                    class="col-sm-4 col-xl-6 order-sm-2 d-flex flex-column align-items-sm-end justify-content-sm-end mb-4 mb-sm-0 ml-1">
                    <h3 class="d-sm-none">Seller</h3>
                    <a href={{route('user_profile', ['username' => $auction->seller->username])}}
                        class="text-decoration-none link-dark d-flex align-items-center flex-row-reverse justify-content-end flex-sm-row justify-content-sm-start">
                        <div class="d-flex flex-column align-items-end ms-3 ms-sm-0 me-0 me-sm-3">
                            <h6 class="d-none d-sm-block text-end text-muted m-0">Seller</h6>
                            <span class="text-end">{{$auction->seller->name}}</span>
                        </div>
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




<div class="container-fluid my-4">
    <div class="row">

        {{-- BOTTOM SIDEBAR --}}
        <section class="col-12 col-md-4 order-md-1 my-2">
            <div class="position-sticky" style="top: 2rem;">
                {{-- Auction details --}}
                <span class="d-flex align-items-end">
                    <h3 class="m-0 p-0">Auction Details</h3>
                </span>
                <hr class="my-1">

                <div id="auction-detail-grid">

                    <div class="auction-detail-2-col border rounded-3" style="grid-area: time;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2.2rem" height="2.2rem" fill="currentColor"
                                class="bi bi-clock-history position-absolute top-0 start-50 translate-middle bg-white fs-2" viewBox="0 0 16 16">
                            <path d="M8.515 1.019A7 7 0 0 0 8 1V0a8 8 0 0 1 .589.022l-.074.997zm2.004.45a7.003 7.003 0 0 0-.985-.299l.219-.976c.383.086.76.2 1.126.342l-.36.933zm1.37.71a7.01 7.01 0 0 0-.439-.27l.493-.87a8.025 8.025 0 0 1 .979.654l-.615.789a6.996 6.996 0 0 0-.418-.302zm1.834 1.79a6.99 6.99 0 0 0-.653-.796l.724-.69c.27.285.52.59.747.91l-.818.576zm.744 1.352a7.08 7.08 0 0 0-.214-.468l.893-.45a7.976 7.976 0 0 1 .45 1.088l-.95.313a7.023 7.023 0 0 0-.179-.483zm.53 2.507a6.991 6.991 0 0 0-.1-1.025l.985-.17c.067.386.106.778.116 1.17l-1 .025zm-.131 1.538c.033-.17.06-.339.081-.51l.993.123a7.957 7.957 0 0 1-.23 1.155l-.964-.267c.046-.165.086-.332.12-.501zm-.952 2.379c.184-.29.346-.594.486-.908l.914.405c-.16.36-.345.706-.555 1.038l-.845-.535zm-.964 1.205c.122-.122.239-.248.35-.378l.758.653a8.073 8.073 0 0 1-.401.432l-.707-.707z"/>
                            <path d="M8 1a7 7 0 1 0 4.95 11.95l.707.707A8.001 8.001 0 1 1 8 0v1z"/>
                            <path d="M7.5 3a.5.5 0 0 1 .5.5v5.21l3.248 1.856a.5.5 0 0 1-.496.868l-3.5-2A.5.5 0 0 1 7 9V3.5a.5.5 0 0 1 .5-.5z"/>
                        </svg>

                        @if ($auction->open)
                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Closes in</h6>
                            <span>{{ $auction->end_date->longAbsoluteDiffForHumans() }}</span>
                        </div>
                        @elseif ($auction->scheduled)
                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Opens in</h6>
                            <span>{{ $auction->end_date->longAbsoluteDiffForHumans() }}</span>
                        </div>
                        @endif

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Duration</h6>
                            <span>{{ $auction->end_date->longAbsoluteDiffForHumans() }}</span>
                        </div>

                        @if ($auction->ended)
                        <div></div>
                        @endif

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Start Date</h6>
                            <time>{{ $auction->start_date }}</time>
                        </div>

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">End Date</h6>
                            <time>{{ $auction->end_date }}</time>
                        </div>
                    </div>


                    <div class="auction-detail-1-col border rounded-3" style="grid-area stats;">

                        <svg xmlns="http://www.w3.org/2000/svg" width="2.2rem" height="2.2rem" fill="currentColor"
                                class="bi bi-clipboard-data position-absolute top-0 start-50 translate-middle bg-white fs-2" viewBox="0 0 16 16">
                            <path d="M4 11a1 1 0 1 1 2 0v1a1 1 0 1 1-2 0v-1zm6-4a1 1 0 1 1 2 0v5a1 1 0 1 1-2 0V7zM7 9a1 1 0 0 1 2 0v3a1 1 0 1 1-2 0V9z"/>
                            <path d="M4 1.5H3a2 2 0 0 0-2 2V14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V3.5a2 2 0 0 0-2-2h-1v1h1a1 1 0 0 1 1 1V14a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V3.5a1 1 0 0 1 1-1h1v-1z"/>
                            <path d="M9.5 1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1-.5-.5v-1a.5.5 0 0 1 .5-.5h3zm-3-1A1.5 1.5 0 0 0 5 1.5v1A1.5 1.5 0 0 0 6.5 4h3A1.5 1.5 0 0 0 11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3z"/>
                        </svg>

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Bidders</h6>
                            <span>{{ $auction->n_bidders }}</span>
                        </div>

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Bids</h6>
                            <span>{{ $auction->n_bids }}</span>
                        </div>
                    </div>

                    <div class="auction-detail-1-col border rounded-3" style="grid-area: money;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="2.2rem" height="2.2rem" fill="currentColor"
                                class="bi bi-coin position-absolute top-0 start-50 translate-middle bg-white fs-2" viewBox="0 0 16 16">
                            <path d="M5.5 9.511c.076.954.83 1.697 2.182 1.785V12h.6v-.709c1.4-.098 2.218-.846 2.218-1.932 0-.987-.626-1.496-1.745-1.76l-.473-.112V5.57c.6.068.982.396 1.074.85h1.052c-.076-.919-.864-1.638-2.126-1.716V4h-.6v.719c-1.195.117-2.01.836-2.01 1.853 0 .9.606 1.472 1.613 1.707l.397.098v2.034c-.615-.093-1.022-.43-1.114-.9H5.5zm2.177-2.166c-.59-.137-.91-.416-.91-.836 0-.47.345-.822.915-.925v1.76h-.005zm.692 1.193c.717.166 1.048.435 1.048.91 0 .542-.412.914-1.135.982V8.518l.087.02z"/>
                            <path fill-rule="evenodd" d="M8 15A7 7 0 1 0 8 1a7 7 0 0 0 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z"/>
                            <path fill-rule="evenodd" d="M8 13.5a5.5 5.5 0 1 0 0-11 5.5 5.5 0 0 0 0 11zm0 .5A6 6 0 1 0 8 2a6 6 0 0 0 0 12z"/>
                        </svg>

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Starting Bid</h6>
                            <span>@currency($auction->starting_bid)</span>
                        </div>

                        <div class="m-2 p-1">
                            <h6 class="text-muted m-0">Bid Increment</h6>
                            <span>{{ $auction->getIncrementString() }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- TABBED AREA --}}
        <section class="col-12 col-md-8 order-md-0 my-2">

            <span class="d-md-none d-flex align-items-end">
                <h3 class="m-0 p-0">Auction Data</h3>
            </span>
            <hr class="my-1 mb-3">

            <div class="container-fluid">
                <ul class="nav nav-tabs" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#graph-tab" type="button" role="tab" aria-controls="graph" aria-selected="true">Chart</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bid-table-tab" type="button" role="tab" aria-controls="bid table" aria-selected="false">Bid Table</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#gallery-tab" type="button" role="tab" aria-controls="contact" aria-selected="false">Gallery</button>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent">
                    <section class="tab-pane fade show active" id="graph-tab" role="tabpanel" aria-labelledby="graph-tab">
                        @if ($auction->has_bids)
                            <!-- Chart.JS -->
                            <script src="https://cdn.jsdelivr.net/npm/chart.js@3.2.1/dist/chart.min.js" crossorigin="anonymous"></script>

                            @php
                                $bid_list = $auction->bids()->orderBy('date', 'desc')->get();
                            @endphp

                            {{-- Data for chart.js --}}
                            <ol id="chart-data" style="display: none;">
                                @foreach ($bid_list as $bid)
                                <li bid_value={{ $bid->value }} bid_timestamp="{{ $bid->date->timestamp }}"></li>
                                @endforeach
                            </ol>

                            {{-- Bid history chart --}}
                            <canvas class="mt-4" id="bid-history-chart"></canvas>
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center p-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="3rem" height="3rem" fill="currentColor"
                                        class="bi bi-graph-down m-3" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 11.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v2.6l-3.613-4.417a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61L13.445 11H10.5a.5.5 0 0 0-.5.5z"/>
                                </svg>
                                <h4 class="m-0">Not stonks</h4>
                                <h6 class="text-muted">Looks like no bids were made yet...</h6>
                            </div>
                        @endif
                    </section>

                    {{-- TAB 2 --}}
                    <section class="tab-pane fade" id="bid-table-tab" role="tabpanel" aria-labelledby="bid-table-tab">
                        @if ($auction->has_bids)
                            {{-- Bid history table --}}
                            <table id="bid-history" class="table table-striped table-hover" style="height: min-content;">
                                <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Bidder</th>
                                    <th scope="col">Bid</th>
                                    <th scope="col">Date</th>
                                </tr>
                                </thead>
                                <tbody>
                                    @foreach ($bid_list as $bid)
                                        @include("partials.bid_table_entry", [
                                            "bid_no" => $loop->remaining + 1,
                                            "auction" => $auction,
                                            "bid_id" => $bid->id,
                                            "value" => $bid->value,
                                            "time" => $bid->date->diffForHumans(),
                                            "hide" => $loop->iteration > 8
                                        ])
                                    @endforeach

                                    <tr class="bid-table-collapsible">
                                        <td></td>
                                        <td>...</td>
                                        <td></td>
                                        <td></td>
                                    </tr>

                                    <tfoot>
                                        <td>
                                            <button class="btn btn-primary" type="button" data-bs-toggle="collapse" data-bs-target=".bid-table-collapsible" aria-expanded="false" aria-controls="bid-table-collapsible">Collapse</button>
                                        </td>
                                        <td>Starting Bid</td>
                                        <td>@currency($auction->starting_bid) &phi;</td>
                                        <td>{{ $auction->start_date->diffForHumans() }}</td>
                                    </tfoot>
                                </tbody>
                            </table>

                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center p-5">
                                <svg xmlns="http://www.w3.org/2000/svg" width="3rem" height="3rem" fill="currentColor"
                                        class="bi bi-graph-down m-3" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M0 0h1v15h15v1H0V0zm10 11.5a.5.5 0 0 0 .5.5h4a.5.5 0 0 0 .5-.5v-4a.5.5 0 0 0-1 0v2.6l-3.613-4.417a.5.5 0 0 0-.74-.037L7.06 8.233 3.404 3.206a.5.5 0 0 0-.808.588l4 5.5a.5.5 0 0 0 .758.06l2.609-2.61L13.445 11H10.5a.5.5 0 0 0-.5.5z"/>
                                </svg>
                                <h4 class="m-0">Not stonks</h4>
                                <h6 class="text-muted">Looks like no bids were made yet...</h6>
                            </div>
                        @endif
                    </section>

                    {{-- TAB 3 --}}
                    <section class="tab-pane fade auction-image-gallery p-4" id="gallery-tab" role="tabpanel" aria-labelledby="gallery-tab">
                        <div style="grid-area: thumb;">
                            <img src={{$auction->getThumbnail('medium')}} alt="Auction image">
                        </div>

                        @foreach ($auction->genImages('medium') as $img)
                        <div>
                            <img src={{$img}} alt="Auction image">
                        </div>
                        @endforeach
                    </section>
                </div>
            </div>
        </section>

    </div>
</div>


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

