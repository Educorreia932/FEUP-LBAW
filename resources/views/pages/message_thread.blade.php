@extends('layouts.app', ['current_page' => 'home'])

@section("content")
    <style>
        #messages > .message {
            margin: 1em;
        }
    </style>

    <section class="bg-light-grey">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')],
            ["title" => "Message Thread"]
        ]])

        {{-- Messages --}}
        <section id="messages">
            @foreach($messages as $message)
                @include("partials.message")
            @endforeach
        </section>
    </section>
@endsection
