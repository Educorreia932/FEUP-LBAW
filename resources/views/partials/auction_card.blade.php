@inject('helper', \App\Helpers\LbawUtils::class)

<a href={{route('auction', ['id' => $auction->id])}} class="card text-decoration-none link-dark text-wrap hover-scale me-sm-3 mb-3 mb-sm-0"
   style="width: 12rem;">
    <img class="card-img-top w-100 @if($auction->nsfw) nsfw @endif"
        style="object-fit: cover; height: 11rem;"
        src="{{$auction->getThumbnail('card')}}" alt="">

    <div class="card-body d-flex" style="overflow: hidden; white-space: nowrap; text-overflow: ellipsis;">
        <h5 class="card-title fw-5">{{ $auction->title }}</h5>
    </div>

    {{-- Footer --}}
    <div class="card-footer d-flex">
{{--        <span class="badge bg-secondary">{{ $helper->formatCurrency($auction->latest->value) }} &phi;</span>--}}
        <small class="text-muted ms-auto">{{ $auction->getTimeRemainingString() }}</small>
    </div>
</a>
