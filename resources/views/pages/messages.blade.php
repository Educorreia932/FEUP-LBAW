@extends('layouts.app', ['current_page' => 'home'])

@section("content")
    <section class="">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')]
        ]])

        {{-- Message threads --}}
        <section id="message-threads">
            <div class="row">
                <p class="col">User</p>
                <p class="col">Topic</p>
                <p class="col">Date</p>
            </div>

            <section id="message-thread-entries">
                @each("partials.message_thread_entry", $threads, "message_thread")
            </section>
        </section>
    </section>
@endsection
