<?php

namespace App\Http\Controllers;

use App\Models\MessageThread;
use Illuminate\Support\Facades\Auth;

class MessagesController extends Controller {
    public function inbox() {
        $threads = Auth::user()->messageThreads;

        return view('pages.message_inbox', [ "threads" => $threads ]);
    }

    public function message_thread($id) {
        $messages = MessageThread::find($id)->messages;

        return view('pages.message_thread', [ "messages" => $messages ]);
    }
}
