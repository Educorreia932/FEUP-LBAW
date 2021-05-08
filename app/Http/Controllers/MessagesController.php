<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\MessageThread;

class MessagesController extends Controller {
    public function inbox() {
        $threads = MessageThread::all()->take(10);

        return view('pages.message_inbox', [ "threads" => $threads ]);
    }

    public function message_thread($id) {
        $messages = MessageThread::find($id)->messages;

        return view('pages.message_thread', [ "messages" => $messages ]);
    }
}
