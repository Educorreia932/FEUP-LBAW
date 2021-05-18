@extends('layouts.app')

@section("content")
    <section class="container-fluid p-4">
        <h1 class="mt-4">Inbox</h1>

        @include("partials.breadcrumbs", [ "pages" => [
            ["title" => "Home", "href" => route('home')],
            ["title" => "Messages", "href" => route('inbox')]
        ]])

        <hr>

        {{-- Message threads --}}
        <section id="message-threads" class="d-flex flex-column justify-content-center">
            <section id="message-thread-entries" class="w-75">
                @foreach ($threads as $message_thread)
                <div class="row hover-highlight py-3 rounded">
                    {{-- Participants --}}
                    <div class="col-3 col-md-2 col-lg-1 container d-none d-sm-flex align-items-center justify-content-end">
                        @foreach($message_thread->other_participants as $participant)
                            @if ($loop->iteration == 3 && $loop->remaining > 0)
                                    <p class="bg-secondary rounded-circle text-white font-smaller text-center mb-0 flex-shrink-0" style="margin-right: -15px; padding-top: 3px; width: 40px; height: 40px;">...</p>
                                @break
                            @endif

                            <a href="{{ route("user_profile", [ "username" => $participant->username ]) }}" style="z-index: {{ $loop->remaining }}">
                                <img class="border border-2 rounded-circle border-secondary" style="margin-right: -15px;" width="40" height="40"
                                    src="{{ $participant->getImage('small') }} "
                                    alt="Profile Image"
                                    class=""></a>

                            @break($loop->iteration == 3)
                        @endforeach
                    </div>

                    {{-- Thread --}}
                    <a id="message-thread-topic " class="col d-flex flex-column align-items-start justify-content-center text-decoration-none text-dark"
                        href="{{ route("message_thread", [ "thread_id" => $message_thread->id ]) }}">
                        <span class="text-center">
                        @foreach($message_thread->other_participants as $participant)
                            @if ($loop->iteration == 3)
                                {{ $participant->name }}@if ($loop->remaining > 0) & {{ $loop->remaining }} others @endif
                                @break
                            @endif

                            {{ $participant->name }}@if (!$loop->last), @endif
                        @endforeach
                        </span>
                    </a>

                    {{-- Last message sent at --}}
                    <a class="col-2 d-flex flex-column align-items-start justify-content-center text-decoration-none text-muted"
                        href="{{ route("message_thread", [ "thread_id" => $message_thread->id ]) }}">
                        @if($message_thread->messages->count() == 0)
                            <span class="text-center">none</span>
                        @else
                            <span class="text-center">{{ $message_thread->messages->last()->timestamp->shortRelativeDiffForHumans() }}</span>
                        @endif
                    </a>

                </div>

                @if (!$loop->last)
                    <hr class="my-1">
                @endif
                @endforeach
            </section>
        </section>
    </section>
@endsection
