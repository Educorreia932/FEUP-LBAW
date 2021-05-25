@extends('layouts.app', ['title' => 'Message Thread'])

@section("content")
    <script defer src="{{ asset("js/message_thread.js") }}"></script>

    <link href="{{ asset('css/scrollbars.css') }}" rel="stylesheet">

    <section class="row flex-grow-1 px-0 bg-light-grey m-0">

        <div class="col-3 p-0 align-items-stretch bg-white flex-grow-0 flex-shrink-0 border-end">
            <div class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-5 fw-semibold">Inbox</span>
            </div>

            <section class="d-flex flex-column align-items-stretch flex-grow-1 scroll-hover" style="height: 1em;">
                <div class="list-group list-group-flush border-bottom scrollarea">

                    {{-- All Threads --}}
                    @foreach (Auth::user()->orderedThreads()->get() as $t)
                    <a href="{{ route('message_thread', ['thread_id' => $t->id]) }}" data-thread-id="{{ $t->id }}"
                        class="message-thread-entry d-flex flex-column align-items-stretch list-group-item list-group-item-action py-3 lh-tight @if ($t->id == $thread->id) active @endif">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1 text-truncate">{{ $t->topic }}</strong>
                            <small class="message-thread-timestamp @if ($t->id != $thread->id) text-muted @endif">{{ $t->latest != null ? $t->latest->timestamp->shortAbsoluteDiffForHumans() : "-" }}</small>
                        </div>
                        <small class="message-thread-body mb-1 text-truncate">{{ $t->latest != null ? $t->latest->body : "none" }}</small>
                    </a>
                    @endforeach

                </div>
            </section>
        </div>

        <div class="col-9 d-flex flex-column p-0">
            {{-- Header --}}
            <div id='thread-identifier' data-thread-id="{{ $thread->id }}" class="p-2 d-flex flex-row justify-content-between bg-white border-bottom">
                <div class="d-flex flex-row align-items-center">
                    <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                            data-bs-target="#edit-modal">
                        <i class="bi bi-pencil" style="font-size: 1.5em;"></i>
                    </button>

                    <div>
                        <h3 class='m-0 text-truncate'>{{ $thread->topic }}</h3>
                        <h6 class='m-0 text-truncate'>
                        @foreach($thread->other_participants as $participant)
                            @if ($loop->iteration == 3)
                                <a class="text-decoration-none link-dark" href="{{ route('user_profile', ['username' => $participant->username ]) }}">{{ $participant->name }}</a>@if ($loop->remaining > 0) & {{ $loop->remaining }} others @endif
                                @break
                            @endif

                            <a class="text-decoration-none link-dark" href="{{ route('user_profile', ['username' => $participant->username ]) }}">{{ $participant->name }}@if (!$loop->last), @endif
                        @endforeach</h6>
                    </div>
                </div>

                <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                        data-bs-target="#add-user-modal">
                    <i class="bi-person-plus" style="font-size: 1.5em;"></i>
                </button>

            </div>

            {{-- Messages --}}
            <section id="messages" class="d-flex flex-column flex-grow-1 overflow-auto" style="height: 1em;">

                <div class="m-4 mt-2 border-bottom">
                    <p class="m-0">Welcome to the beginning of the <strong>{{ $thread->topic }}</strong> thread!</p>
                    <p>Created {{ $thread->created->toDayDateTimeString() }}</p>
                </div>

                @foreach($thread->messages as $message)
                    @include("partials.message", ['self' => Auth::id() == $message->sender->id])
                @endforeach
            </section>

            {{-- Send message --}}
            <form id="send-message-form" class="input-group my-2 bottom-0 start-50 translate-middle-x px-4 w-75">
                @csrf

                <div class="input-group">
                    <input
                        id="body"
                        type="text"
                        autocomplete="off"
                        class="form-control"
                        placeholder="Aa"
                        aria-label="Write a message"
                        aria-describedby="send-addon"
                        name="body"
                        @if (Auth::user()->banned) disabled @endif>
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-arrow-up-right"></i></button>
                </div>

                <input hidden id="sender_id" name="sender_id" value={{ Auth::user()->id }}>
                <input hidden id="thread_id" name="thread_id" value={{ $thread->id }}>
            </form>
        </div>

    </section>


{{-- Contact modal --}}
<section class="modal fade" id="add-user-modal" tabindex="-1" aria-labelledby="add-user-modal-title" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="send-message-modal-title">
                    Add user to current Thread
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form id="contact-user-form" method="post" action="{{ route('add_participant_to_message_thread', ['thread_id' => $thread->id]) }}">
                @csrf

                <div class="modal-body">
                    <p class="fw-bold my-0">Username</p>

                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon1">@</span>
                        <input type="text" class="form-control" name="username" placeholder="Username" aria-label="Username" aria-describedby="basic-addon1">
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Confirm</button>
                </div>
            </form>
        </div>
    </div>
</section>

{{-- Edit modal --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modalLable" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="edit-form" method="post"
              action="{{ route('rename_thread', ['thread_id' => $thread->id]) }}">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="modalLable">Rename Thread</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Auction name --}}
                <div class="form-group col-md-12 mt-3">
                    <label for="inputTopic" class="sr-only">Topic</label>
                    <input type="text" autocomplete="off" maxlength="50" placeholder="{{ $thread->topic }}" id="inputTopic" value="{{ $thread->topic }}" class="form-control"
                        name="topic">
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </form>
    </div>
</div>


@endsection
