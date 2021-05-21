@extends('layouts.app', ['title' => 'Message Thread'])

@section("content")
    <script defer src="{{ asset("js/message_thread.js") }}"></script>

    <section class="big-boy flex-row px-0 bg-light-grey">
        {{-- <div class="pt-2 px-4">
            <h1 class="mt-2" id="thread-title" data-id="{{ $thread->id }}">{{ $thread->title() }}</h1>

            @include("partials.breadcrumbs", [ "pages" => [
                ["title" => "Home", "href" => route('home')],
                ["title" => "Messages", "href" => route('inbox')],
                ["title" => "Message Thread"]
            ]])
        </div> --}}

        <div class="big-boy align-items-stretch bg-white flex-grow-0 flex-shrink-0 border-end" style="width: 340px;">
            <div class="d-flex align-items-center flex-shrink-0 p-3 link-dark text-decoration-none border-bottom">
                <svg class="bi me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
                <span class="fs-5 fw-semibold">Inbox</span>
            </div>

            <section class="d-flex flex-column align-items-stretch flex-grow-1 scroll-hover" style="height: 1em;">
                <div class="list-group list-group-flush border-bottom scrollarea">

                    @foreach ($threads as $t)
                    <a href="{{ route('message_thread', ['thread_id' => $t->id]) }}" class="list-group-item list-group-item-action py-3 lh-tight @if ($t->id == $thread->id) active @endif">
                        <div class="d-flex w-100 align-items-center justify-content-between">
                            <strong class="mb-1">Thread Name</strong>
                            <small class="@if ($t->id != $thread->id) text-muted @endif">{{ $t->messages->last() != null ? $t->messages->last()->timestamp->shortAbsoluteDiffForHumans() : "-" }}</small>
                        </div>
                        <div class="col-10 mb-1 small">{{ $t->messages->last() != null ? $t->messages->last()->body : "none" }}</div>
                    </a>
                    @endforeach

                </div>
            </section>
        </div>

        <div class="big-boy">
            {{-- Header --}}
            <div class="p-2 bg-white border-bottom">
                <div class="d-flex flex-row align-items-center">
                    <button type="button" class="btn hover-scale" data-bs-toggle="modal"
                            data-bs-target="#edit-modal">
                        <i class="bi bi-pencil" style="font-size: 1.25em; text-align: right"></i>
                    </button>
                    <h3 class='m-0'>Thread Name</h3>
                </div>
                <h6 class='m-0 ps-5'>
                @foreach($thread->other_participants as $participant)
                    @if ($loop->iteration == 3)
                        {{ $participant->name }}@if ($loop->remaining > 0) & {{ $loop->remaining }} others @endif
                        @break
                    @endif

                    {{ $participant->name }}@if (!$loop->last), @endif
                @endforeach</h6>
            </div>

            {{-- Messages --}}
            <section id="messages" class="d-flex flex-column flex-grow-1 overflow-auto" style="height: 1em;">
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
                        name="body">
                    <button class="btn btn-outline-secondary" type="submit" id="button-addon2"><i class="bi bi-arrow-up-right"></i></button>
                </div>

                <input hidden id="sender_id" name="sender_id" value={{ Auth::user()->id }}>
                <input hidden id="thread_id" name="thread_id" value={{ $thread->id }}>
            </form>
        </div>
    </section>


{{-- Edit modal --}}
<div class="modal fade" id="edit-modal" tabindex="-1" aria-labelledby="modalLable" aria-hidden="true">
    <div class="modal-dialog">
        <form class="modal-content" id="edit-form" method="post"
              action="">
            @csrf

            <div class="modal-header">
                <h5 class="modal-title" id="modalLable">Rename Thread</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                {{-- Auction name --}}
                <div class="form-group col-md-12 mt-3">
                    <label for="inputName" class="sr-only">Topic</label>
                    <input type="text" id="inputName" value="{{ $thread->topic }}" class="form-control"
                        name="title">
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
