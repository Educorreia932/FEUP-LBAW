<?php

namespace App\Events;

use App\Models\Message;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($message) {
        $this->message = $message;
    }

    public function broadcastOn() {
        return new PrivateChannel('message_thread');
    }
}
