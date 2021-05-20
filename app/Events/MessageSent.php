<?php

namespace App\Events;

use App\Models\Message;
use App\Models\MessageThread;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast {
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private Message $message;

    use Dispatchable, InteractsWithSockets, SerializesModels;

    public function __construct($message) {
        $this->message = $message;
    }

    /**
     * Get the data to broadcast.
     *
     * @return array
     */
    public function broadcastWith()
    {
        return [
            'body' => $this->message->body,
            'sender_username' => $this->message->sender->username,
            'sender_name' => $this->message->sender->name,
            'sender_id' => $this->message->sender->id,
        ];
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn() {
        return new PrivateChannel('message_thread.' . $this->message->thread->id);
    }

}

