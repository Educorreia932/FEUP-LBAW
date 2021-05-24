<?php

namespace App\Policies;

use App\Models\Member;
use App\Models\MessageThread;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Support\Facades\Log;

class MessageThreadPolicy {
    use HandlesAuthorization;

    /**
     * Determine whether the user can view a message_thread.
     */
    public function view(Member $member, MessageThread $message_thread) {
        return $message_thread->isParticipant($member->id);
    }

    /**
     * Determine whether the user can add another to a message_thread.
     */
    public function addUser(Member $member, MessageThread $message_thread, Member $other) {
        return !$member->banned && !$other->banned && $message_thread->isParticipant($member->id) && !$message_thread->isParticipant($other->id);
    }

    /**
     * Determine whether the user can send messages to a thread
     */
    public function sendMessage(Member $member, MessageThread $message_thread) {
        return !$member->banned && $message_thread->isParticipant($member->id);
    }

    /**
     * Determine whether the user can rename a thread's topic
     */
    public function renameTopic(Member $member, MessageThread $message_thread) {
        return !$member->banned && $message_thread->isParticipant($member->id);
    }
}
