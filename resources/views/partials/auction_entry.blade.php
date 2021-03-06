<div class="row auction-entry py-2 pe-md-2 hover-highlight rounded-3">
    <!-- Product image -->
    <a href="{{ route('auction', ['id' => $auction->id]) }}" class="col-md-3 col-lg-2 mb-2 mb-md-0 auction-entry-img-container">
       <img class="img-thumbnail @if($auction->nsfw) nsfw @endif" src="{{ $auction->getThumbnail('card') }}">
    </a>

    <div class="col-md d-flex flex-column justify-content-between">
        <div class="d-flex justify-content-between align-items-center">
            <div>
                <h4 class="d-flex align-items-center mb-0">
                    @auctionStatus($auction)
                    <a class="text-decoration-none link-dark" href={{route('auction', ['id' => $auction->id])}}>{{ $auction->title }}</a>
                </h4>
                <span class="text-muted">
                    Created by
                    <a class="text-decoration-none link-dark" href={{route("user_profile", ['username' => $auction->seller->username])}}>
                        {{ $auction->seller()->getResults()->username }}
                    </a>
                </span>
                <p class="mb-1 text-muted">{{ $auction->category }}</p>
            </div>

            @auth
                <button type="button" class="btn auction-bookmark hover-scale p-0 align-self-start"
                        auction_id="{{ $auction->id }}">
                    <i class="bi @if (Auth::user()->bookmarkedAuction($auction->id)) bi-bookmark-dash-fill @else bi-bookmark-plus @endif"
                       style="font-size: 2.5em; text-align: right"></i>
                </button>
            @endauth
        </div>

        <div class="row mt-3">
            <div class="col-sm d-flex flex-column justify-content-end">
                <div class="row">
                    @if ($auction->ended)
                    <div class="col">
                        @if ($auction->latest_bid != null)
                        <span>Winning bid</span>
                        <h4 class="mb-0">@currency($auction->current_bid) &phi;</h4>
                        @else
                        <h4 class="mb-0">No bids were made</h4>
                        @endif
                    </div>
                    @elseif ($auction->started)
                    <div class="col">
                        @if ($auction->latest_bid != null)
                        <span>Current bid</span>
                        <h4 class="mb-0">@currency($auction->current_bid) &phi;</h4>
                        @else
                        <h4 class="mb-0">No bids yet</h4>
                        @endif
                    </div>
                    @endif
                </div>
            </div>

            <div class="col-sm d-flex flex-column mt-3 mt-0-sm align-items-sm-end">
                <span><span class="fw-bold" style="font-size: x-small;">Starts </span>{{ $auction->start_date }}</span>
                <span><span class="fw-bold" style="font-size: x-small;">Ends </span>{{ $auction->end_date }}</span>
            </div>
        </div>
    </div>
</div>
