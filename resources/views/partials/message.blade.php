@if( $message->sender == Auth::user() )
    <div class="message rounded p-2 bg-primary text-white">
        <strong>{{ $message->sender->username }}</strong>
        <p class="m-0">{{ $message->body }}</p>
    </div>
@else
    <div class="message rounded p-2 bg-white">
        <strong>{{ $message->sender->username }}</strong>
        <p class="m-0">{{ $message->body }}</p>
    </div>
@endif




