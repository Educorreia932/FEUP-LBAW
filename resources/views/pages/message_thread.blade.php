@extends('layouts.app')

@section("content")
    <script defer src="{{ asset("js/send_message.js") }}"></script>

    <section class="container-fluid big-boy bg-light-grey p-4">
        <h1 class="mt-4">{{ $thread->title() }}</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')],
            ["title" => "Message Thread"]
        ]])

        <div class="px-5 big-boy position-relative">
            {{-- Messages --}}
            <section id="messages" class="d-flex flex-column overflow-auto" style="height: 20em">
                @foreach($thread->messages as $message)
                    @include("partials.message")
                @endforeach
            </section>

            {{-- Send message --}}
            <form id="send-message-form" class="input-group my-4 position-absolute bottom-0 start-50 translate-middle-x" style="width: 30em">
                @csrf

                <input
                    id="body"
                    type="text"
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
