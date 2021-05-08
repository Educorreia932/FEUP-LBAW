<div class="row">
    <a class="col"
       href="{{ route("user_profile", [ "username", $message_thread->messages->first()->sender->username ]) }}">
        {{ $message_thread->messages->first()->sender->username }}
    </a>
    <a class="col"
       href="{{ route("message_thread", [ "thread_id" => $message_thread->id ]) }}">{{ $message_thread->topic }}</a>
    <p class="col">Date</p>
</div>
