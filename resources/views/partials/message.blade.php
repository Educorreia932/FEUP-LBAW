<div class="message mb-3 d-flex align-items-center" style="max-width: 70%">
    <img style="border-radius:50%;" width="40" height="40"
         src="{{ $message->sender->getImage('small') }} "
         alt="Profile Image"
         class="me-3"
    >

    <div class="bg-white d-inline-block p-2 rounded px-3">
        <a class="link-dark text-decoration-none"
           href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
            <strong>{{ $message->sender->name }}</strong>
        </a>
        <p class="m-0">{{ $message->body }}</p>
    </div>

    <p class="m-1 text-muted flex-shrink-0">
        {{ $message->timestamp->shortRelativeDiffForHumans() }}
    </p>
</div>

