<div class="message mb-3 d-flex align-items-center
    @if ($self) align-self-end flex-row-reverse @else align-self-start flex-row @endif"
    style="max-width: 70%; min-width: 45%;">

    <a href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
        <img style="border-radius:50%;" width="40" height="40" class="m-3" @profilepic($message->sender, small)>
    </a>

    <div class="flex-grow-1 @if ($self) bg-primary text-white @else bg-white @endif d-inline-block p-2 rounded px-3">
        <h6 class="@if ($self) text-light @else text-dark @endif">
            <strong>{{ $message->sender->name }}</strong>
        </h6>
        <p class="m-0">{{ $message->body }}</p>
    </div>

    <p class="m-1 text-muted flex-shrink-0">
        {{ $message->timestamp->shortRelativeDiffForHumans() }}
    </p>
</div>

