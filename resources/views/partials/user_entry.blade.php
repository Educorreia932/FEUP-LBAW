<div class="row hover-highlight py-2 pe-md-2 rounded-3">
    <div class="col-5 col-sm-3 col-lg-2 p-0 d-flex align-content-center justify-content-center">
        <a href={{route('user_profile', ['username' => $member->username])}}>
            <img style="border-radius: 50%;" width="120" height="120" @profilepic($member, medium)>
        </a>
    </div>
    <div class="col-7 col-sm-9 col-lg-10">
        <div class="d-flex flex-column mb-3 mb-md-0">
            <div class="d-flex flex-column flex-md-row">
                <a href={{route('user_profile', ['username' => $member->username])}} class="text-decoration-none text-dark col-sm-10 col-md-8 col-lg-6 col-xl-5">
                    <h4 class="m-0 text-truncate me-2">{{ $member->name }}</h4>
                </a>
                <p class="m-0 col">{{ $member->rating }} <i class="bi bi-star"></i></p>
            </div>
            <span class="fst-italic">&commat;{{ $member->username }}</span>
        </div>
        <p class="d-none d-md-block mb-3"><span class="text-muted">Joined on</span> {{ $member->joined->toFormattedDateString() }}</p>
        @auth
        <div class="col-12 col-sm-6 col-md-4 col-lg-3 col-xl-2">
            @if (Auth::id() != $member->id)
            @if (Auth::user()->followsMember($member->id))
                <button type="button" class="follow btn btn-danger w-100" member_username="{{ $member->username }}">
                    <i class="bi bi-heart-fill"></i>
                    <span>Following</span>
                </button>
            @else
                <button type="button" class="follow btn btn-outline-danger w-100" member_username="{{ $member->username }}">
                    <i class="bi bi-heart"></i>
                    <span>Follow</span>
                </button>
            @endif
            @endif
        </div>
        @endauth
    </div>
</div>

@if(isset($last) && !$last)
<hr>
@endif
