@extends('layouts.app')

@section("content")
    <script defer src="{{ asset("js/send_message.js") }}"></script>

    <section class="container-fluid bg-light-grey p-4">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')],
            ["title" => "Message Thread"]
        ]])

        <div class="px-5">
            {{-- Messages --}}
            <section id="messages" class="d-flex flex-column overflow-auto" style="max-height: 25em;">
                @foreach($messages as $message)
                    @include("partials.message")
                @endforeach
            </section>

            {{-- Send message --}}
            <form id="send-message-form" class="container-fluid input-group my-4 px-5">
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

                <button id="send-addon" type="submit" class="input-group-text border-0">
                    <i class="bi bi-arrow-up-right"></i>
                </button>
            </form>
        </div>
    </section>
@endsection
