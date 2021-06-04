<div class="me-2">
    <img style="border-radius:50%;" width="40" height="40" @profilepic($auction->seller, small)>
</div>

<div>
    <a href="{{ route("user_profile", [ "username" => $auction->seller->username ] ) }}">{{ $auction->seller->name }}</a>
    created a new auction <a href="{{ route("auction", [ "id" => $auction->id ]) }}">{{ $auction->title }}</a>.
</div>
