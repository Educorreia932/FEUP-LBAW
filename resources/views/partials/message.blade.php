@if( $message->sender == Auth::user() )
    <div class="message align-self-end" style="margin: 1em">
        <div class="bg-primary text-white mw-50 d-inline-block p-2 rounded ">
            <a class="link-light text-decoration-none"
               href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
                <strong>{{ $message->sender->name }}</strong>
            </a>
            <p class="m-0">{{ $message->body }}</p>
        </div>
    </div>
@else
    <div class="message" style="margin: 1em">
        <div class="bg-white mw-50 d-inline-block p-2 rounded">
            <a class="link-dark text-decoration-none"
               href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
                <strong>{{ $message->sender->name }}</strong>
            </a>
            <p class="m-0">{{ $message->body }}</p>
        </div>
    </div>
@endif

