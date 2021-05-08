@php
    $sender_username = $message_thread->messages->first()->sender->username;
@endphp

<div class="row">
    <a class="col" href="{{ route("user_profile", [ "username", $sender_username ]) }}">
        {{ $sender_username }}
    </a>
    <a class="col" href="{{ route("message_thread", [ "thread_id" => $message_thread->id ]) }}">
        aaaaa
    </a>
    <p class="col">Date</p>
</div>
