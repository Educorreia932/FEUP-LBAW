@extends('layouts.app', ['title' => 'Message Thread'])

@section("content")
    <script defer src="{{ asset("js/message_thread.js") }}"></script>

    <section class="container-fluid px-0 big-boy bg-light-grey">
        <div class="pt-2 px-4">
            <h1 class="mt-2" id="thread-title" data-id="{{ $thread->id }}">{{ $thread->title() }}</h1>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Home", "href" => route('home')],
                ["title" => "Messages", "href" => route('inbox')],
                ["title" => "Message Thread"]
            ]])
        </div>

        <div class="big-boy">
            {{-- Messages --}}
            <section id="messages" class="d-flex flex-column flex-grow-1 overflow-auto" style="height: 1em;">
                @foreach($thread->messages as $message)
                    @include("partials.message", ['self' => Auth::id() == $message->sender->id])
                @endforeach
            </section>

            {{-- Send message --}}
            <form id="send-message-form" class="input-group my-2 bottom-0 start-50 translate-middle-x px-4 w-75">
                @csrf

                <input
                    id="body"
                    type="text"
                    autocomplete="off"
                    class="form-control"
                    placeholder="Write a message"
                    aria-label="Write a message"
                    aria-describedby="send-addon"
                    name="body"
                />

                <input hidden id="sender_id" name="sender_id" value={{ Auth::user()->id }}>
                <input hidden id="thread_id" name="thread_id" value={{ $thread->id }}>

                <button id="send-addon" type="submit" class="input-group-text border-0">
                    <i class="bi bi-arrow-up-right"></i>
                </button>
            </form>
        </div>
    </section>
@endsection
