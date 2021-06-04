<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;

class NotificationController extends Controller {
    public function markAsRead($id) {
        Notification::where("id", $id)->update(["read" => "true"]);

        return [
            'status' => 'Marked notification as read!',
            "unread_count" => Auth::user()->notifications()->where("read", "false")->count()
        ];
    }
}
