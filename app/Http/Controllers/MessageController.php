<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\SendMessageRequest;
use App\Models\Member;
use App\Models\Message;
use App\Models\MessageThread;
use App\Models\MessageThreadParticipant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller {
    public function showInbox() {
        $threads = Auth::user()->messageThreads;

        return view('pages.message_inbox', ["threads" => $threads]);
    }

    public function showMessageThread($thread_id) {
        $message_thread = MessageThread::find($thread_id);

        if (!$message_thread->participants()->where('participant_id', '=', Auth::id())->count() > 0)
            abort(403);

        return view('pages.message_thread', ["thread" => $message_thread]);
    }

    public function createMessageThread(Request $request) {
        $message_thread = MessageThread::create();
        $message_thread->addParticipant($request->get("user_id"));
        $message_thread->addParticipant(Auth::id());

        return redirect(route("message_thread", ["thread_id" => $message_thread->id]));
    }

    public function addParticipantToThread(Request $request) {
        $message_thread = MessageThread::find($request->get("thread_id"));
        $message_thread->addParticipant($request->get("user_id"));

        return redirect(route("message_thread", ["thread_id" => $message_thread->id]));
    }

    public function sendMessage($thread_id, SendMessageRequest $request) {
        $thread = MessageThread::findOrFail($thread_id);
        // $this->authorize('sendMessage', $thread);

        $validated = $request->validated();
        $validated += ["thread_id" => $thread_id];

        $message = Message::create($validated);
        $message = Message::find($message->id);

        broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
