<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\MessageThread;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class MessagePolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a message_thread.
     */
    public function view(Member $member, MessageThread $message_thread) {
        return $message_thread->isParticipant($member->id);
    }

    public function sendMessage(Member $member, MessageThread $message_thread) {
        Log::debug($member->username);
        Log::debug($message_thread);
        return $message_thread->isParticipant($member->id);
    }
}
