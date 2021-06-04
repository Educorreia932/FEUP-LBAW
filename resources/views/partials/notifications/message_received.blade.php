<div class="me-2">
    <img style="border-radius:50%;" width="40" height="40" @profilepic($user, small)>
</div>

<div>
    You have a new <a href="{{ route("message_thread", ["thread_id" => $message->thread->id]) }}">message</a> from
    <a href="{{ route("user_profile", ["username" => $user->username] ) }}">{{ $user->name }}</a>.
</div>
