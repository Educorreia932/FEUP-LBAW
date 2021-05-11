<?php

namespace App\Http\Controllers;

use App\Events\MessageSent;
use App\Http\Requests\SendMessageRequest;
use App\Models\Message;
use App\Models\MessageThread;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller {
    public function inbox() {
        $threads = Auth::user()->messageThreads;

        return view('pages.message_inbox', ["threads" => $threads]);
    }

    public function messageThread($thread_id) {
        $message_thread = MessageThread::find($thread_id);

        if (!$message_thread->participants()->where('participant_id', '=', Auth::id())->count() > 0)
            abort(403);

        return view('pages.message_thread', ["messages" => $message_thread->messages, "thread_id" => $thread_id]);
    }

    public function showMessage($message) {
        return view("partials.message", ["message" => $message]);
    }

    public function sendMessage($id, SendMessageRequest $request) {
        $validated = $request->validated();
        $validated += ["thread_id" => $id];

        $message = Message::create($validated);
        $message = Message::find($message->id);

        MessageSent::dispatch($this->showMessage($message));

        return ['status' => 'Message Sent!'];
    }
}
