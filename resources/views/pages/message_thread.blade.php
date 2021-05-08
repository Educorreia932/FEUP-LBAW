@extends('layouts.app')

@section("content")
    <section class="container-fluid bg-light-grey p-4">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')],
            ["title" => "Message Thread"]
        ]])

        {{-- Messages --}}
        <section id="messages" class="d-flex flex-column px-5">
            @foreach($messages as $message)
                @include("partials.message")
            @endforeach
        </section>

        {{-- Send message --}}
        <form class="container input-group my-4">
            <input type="text" class="form-control"
                   placeholder="Write a message"
                   aria-label="Write a message"
                   aria-describedby="send-addon"
            />
            <button id="send-addon" class="input-group-text border-0">
                <i class="bi bi-arrow-up-right"></i>
            </button>
        </form>
    </section>
@endsection
