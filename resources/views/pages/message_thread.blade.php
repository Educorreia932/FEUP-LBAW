@extends('layouts.app', ['current_page' => 'home'])

@section("content")
    <section class="bg-light-grey">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')],
            ["title" => "Message Thread"]
        ]])

        {{-- Messages --}}
        <section id="messages" class="d-flex flex-column">
            @foreach($messages as $message)
                @include("partials.message")
            @endforeach
        </section>
    </section>
@endsection
