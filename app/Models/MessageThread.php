<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageThread extends Model {
    use HasFactory;

    protected $table = 'message_thread';

    public function messages() {
        return $this->hasMany(Message::class, "thread_id");
    }
}
