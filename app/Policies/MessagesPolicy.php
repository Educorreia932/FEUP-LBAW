<?php

namespace App\Policies;

use App\Models\MessageThread;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Auth;

class MessagesPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a message_thread.
     */
    public function view(MessageThread $message_thread) {
        return !$message_thread->participants()->where('participant_id', '=', Auth::id())->count() > 0;
    }
}
