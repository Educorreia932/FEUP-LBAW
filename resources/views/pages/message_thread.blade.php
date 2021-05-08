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
    </section>
@endsection
