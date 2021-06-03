<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MessageNotification extends Model {
    protected $table = 'message_notification';

    protected $primaryKey = 'notification_id';

    public function message() {
        return $this->hasOne(
            Message::class,
            "id",
            "message_id"
        );
    }
}
