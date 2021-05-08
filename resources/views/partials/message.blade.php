<div class="message d-block">
    @if( $message->sender == Auth::user() )
        <div class="bg-primary text-white mw-50 d-inline-block p-2 rounded">
            <a class="link-light text-decoration-none"
               href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
                <strong>{{ $message->sender->name }}</strong>
            </a>
            <p class="m-0">{{ $message->body }}</p>
        </div>

    @else
        <div class="bg-white mw-50 d-inline-block p-2 rounded">
            <a class="link-dark text-decoration-none"
               href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
                <strong>{{ $message->sender->name }}</strong>
            </a>
            <p class="m-0">{{ $message->body }}</p>
        </div>
    @endif
</div>

