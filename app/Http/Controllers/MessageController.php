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
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RuntimeException;

class MessageController extends Controller {
    public function showInbox() {
        $latest_thread = Auth::user()->orderedThreads()->first();

        if ($latest_thread == null)
            return view('pages.empty_inbox');

        return redirect(route('message_thread', ['thread_id' => $latest_thread->id]));
    }

    public function showMessageThread($thread_id) {
        $thread = MessageThread::findOrFail($thread_id);
        $this->authorize('view', $thread);

        $threads = Auth::user()->messageThreads;

        return view('pages.message_thread', ["thread" => $thread, "threads" => $threads]);
    }

    public function createMessageThread(Request $request) {
        $thread = MessageThread::create();
        $thread->addParticipant($request->get("user_id"));
        $thread->addParticipant(Auth::id());

        return redirect(route("message_thread", ["thread_id" => $thread->id]));
    }

    public function addParticipantToThread($thread_id, Request $request) {
        $thread = MessageThread::findOrFail($thread_id);
        $other = Member::all()->where('username', '=', $request->get("username"))->first();
        if ($other == null)
            return abort(404);

        $this->authorize('addUser', [$thread, $other]);

        $thread->addParticipant($other->id);

        return redirect(route("message_thread", ["thread_id" => $thread->id]));
    }

    public function sendMessage($thread_id, SendMessageRequest $request) {
        $thread = MessageThread::findOrFail($thread_id);
        $this->authorize('sendMessage', $thread);

        $validated = $request->validated();
        $validated += ["thread_id" => $thread_id];

        $message = Message::create($validated);
        $message = Message::find($message->id);

        try {
            broadcast(new MessageSent($message))->toOthers();
        } catch (RuntimeException $e) {
            Log::error("Failed on send message:\n" . $e);
        }

        return ['status' => 'Message Sent!'];
    }

    public function renameThread($thread_id, Request $request) {
        $thread = MessageThread::findOrFail($thread_id);
        $this->authorize('renameTopic', $thread);

        $rules = array(
            'topic' => ['required', 'string', 'min:1', 'max:50']
        );

        $messages = array(
            'required' => ':attribute must be filled',
            'min' => ':attribute must have at least :min characters'
        );
        $validator = Validator::make($request->all(), $rules, $messages);

        $thread->update($validator->validated());

        return redirect(route('message_thread', ['thread_id' => $thread_id]));
    }
}
