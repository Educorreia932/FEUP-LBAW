<?php

use App\Models\MessageThread;
use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('message_thread.{thread_id}', function ($user, $thread_id) {
    return MessageThread::findOrFail($thread_id)->isParticipant($user->id);
});
