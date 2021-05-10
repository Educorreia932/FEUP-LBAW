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

    public function messageThread($id) {
        $messages = MessageThread::find($id)->messages;

        return view('pages.message_thread', ["messages" => $messages, "thread_id" => $id]);
    }

    public function sendMessage($thread_id, SendMessageRequest $request) {
        $validated = $request->validated();
        $validated += ["thread_id" => $thread_id];

        $message = Message::create($validated);

        broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
