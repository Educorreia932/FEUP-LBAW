<div class="message mb-3 d-flex align-items-center">
    <img style="border-radius:50%;" width="40" height="40"
         src="{{ $message->sender->getImage('small') }} "
         alt="Profile Image"
         class="me-3"
    >

    <div class="bg-white mw-50 d-inline-block p-2 rounded px-3">
        <a class="link-dark text-decoration-none"
           href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
            <strong>{{ $message->sender->name }}</strong>
        </a>
        <p class="m-0">{{ $message->body }}</p>
    </div>
</div>

