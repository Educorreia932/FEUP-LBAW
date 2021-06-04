<?php

namespace App\Http\Controllers;

use App\Models\Notification;

class NotificationController extends Controller {
    public function markAsRead($id) {
        Notification::where("id", $id)->update(["read" => "true"]);

        return ['status' => 'Marked notification as read'];
    }
}
