<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent {
    public Message $message;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct(Message $message) {
        $this->message = $message;
    }

    public function broadcastOn() {
        return new PrivateChannel('message_thread');
    }
}
