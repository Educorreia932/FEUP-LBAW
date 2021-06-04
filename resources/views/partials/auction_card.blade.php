<a href="{{route('auction', ['id' => $auction->id])}}"
   class="card text-decoration-none link-dark hover-scale me-sm-3 mb-3 mb-sm-0"
   style="width: 12rem;">
    <img class="card-img-top w-100 @if($auction->nsfw) nsfw @endif"
         style="object-fit: cover; height: 11rem;"
         src="{{$auction->getThumbnail('card')}}" alt="">

    <div class="card-body">
        <h5 class="card-title fw-5 d-inline-block text-truncate" style="max-width: 10rem;">{{ $auction->title }}</h5>
    </div>

    {{-- Footer --}}
    <div class="card-footer d-flex">
        @if (!$auction->ended)
            <span class="badge bg-primary">@currency($auction->next_bid) &phi;</span>
        @endif
        <small class="text-muted ms-auto">{{ $auction->getTimeRemainingString() }}</small>
    </div>
</a>
