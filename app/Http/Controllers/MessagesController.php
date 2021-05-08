<?php

namespace App\Http\Controllers;

use App\Models\MessageThread;

class MessagesController extends Controller {
    public function inbox() {
        $threads = MessageThread::all()->take(10);

        return view('pages.messages', [ "threads" => $threads ]);
    }

    public function message_thread($id) {
        return view('pages.message_thread');
    }
}
