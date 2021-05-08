@extends('layouts.app', ['current_page' => 'home'])

@section("content")
    <section class="container-fluid p-4">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')]
        ]])

        {{-- Message threads --}}
        <section id="message-threads">
            <div class="row">
                <p class="col-3">Participants</p>
                <p class="col-6">Topic</p>
                <p class="col">Last message sent at</p>
            </div>

            <section id="message-thread-entries">
                @each("partials.message_thread_entry", $threads, "message_thread")
            </section>
        </section>
    </section>
@endsection
