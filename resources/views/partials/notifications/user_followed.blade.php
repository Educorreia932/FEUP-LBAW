<div class="me-2">
    <img style="border-radius:50%;" width="40" height="40" @profilepic($user, small)>
</div>

<div>
    <a href="{{ route("user_profile", ["username" => $user->username] ) }}">{{ $user->name }}</a> has started following
    you.
</div>
