<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserNotification extends Model {
    protected $table = 'user_notification';

    protected $primaryKey = 'notification_id';

    public function user() {
        return $this->hasOne(
            Member::class,
            "id",
            "member_id"
        );
    }

    public function notification() {
        return $this->belongsTo(Notification::class, "notification_id", "id");
    }

    public function partial() {
        return view("partials.notifications.user_followed", [
            "user" => $this->user
        ]);
    }
}
