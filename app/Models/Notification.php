<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notification extends Model {
    use HasFactory;

    protected $table = 'notification';

    public $timestamps = false;

    protected $casts = [
        'time' => 'datetime',
    ];

    protected $dateFormat = 'Y-m-d H:i:sO';

    public function subNotification() {
        switch ($this->type) {
            case "User Followed":
                return UserNotification::where("notification_id", $this->id)->first();
            case "Auction Outbid":
            case "Bookmarked Auction":
            case "Created Auction":
                return AuctionNotification::where("notification_id", $this->id)->first();
            case "Message Received":
                return MessageNotification::where("notification_id", $this->id)->first();
        }
    }
}
