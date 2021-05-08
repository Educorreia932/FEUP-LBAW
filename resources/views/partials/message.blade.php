@if( $message->sender == Auth::user() )
    <div class="message rounded p-2 bg-primary text-white">
        <a class="link-light text-decoration-none" href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
            <strong>{{ $message->sender->name }}</strong>
        </a>
        <p class="m-0">{{ $message->body }}</p>
    </div>
@else
    <div class="message rounded p-2 bg-white">
        <a class="link-dark text-decoration-none" href="{{ route("user_profile", [ "username" => $message->sender->username ]) }}">
            <strong>{{ $message->sender->name }}</strong>
        </a>
        <p class="m-0">{{ $message->body }}</p>
    </div>
@endif




