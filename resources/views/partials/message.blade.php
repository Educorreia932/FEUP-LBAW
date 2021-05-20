<div class="message mb-3 d-flex align-items-center
    @if ($self) align-self-end flex-row-reverse @else align-self-start flex-row @endif"
    style="max-width: 70%; min-width: 45%;">

    <img style="border-radius:50%;" width="40" height="40"
         src="{{ $message->sender->getImage('small') }} "
         alt="Profile Image"
         class="m-3"
    >

    <div class="flex-grow-1 @if ($self) bg-info @else bg-white @endif d-inline-block p-2 rounded px-3">
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

