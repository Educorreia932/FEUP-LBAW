<style>

</style>

<div class="row hover-highlight py-3">
    <div class="col-3 container">
        @foreach($message_thread->participants as $participant)
            <a href="{{ route("user_profile", [ "username" => $participant->username ]) }}">
                <img style="border-radius:50%;" width="40" height="40"
                     src="{{ $participant->getImage('small') }} "
                     alt="Profile Image"
                     class="me-2"></a>
        @endforeach
    </div>

    <a id="message-thread-topic" class="col-6" href="{{ route("message_thread", [ "thread_id" => $message_thread->id ]) }}">
        @foreach($message_thread->participants as $participant)
            <span>
                {{ $participant->name }}
            </span>
        @endforeach
    </a>

    <p class="col">{{ $message_thread->messages->last()->timestamp }}</p>
</div>
