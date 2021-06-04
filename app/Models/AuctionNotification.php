<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuctionNotification extends Model {
    protected $table = 'auction_notification';

    protected $primaryKey = 'notification_id';

    public function auction() {
        return $this->hasOne(
            Auction::class,
            "id",
            "auction_id"
        );
    }

    public function notification() {
        return $this->belongsTo(Notification::class, "notification_id", "id");
    }

    public function partial() {
        switch ($this->notification->type) {
            case "Auction Outbid":
                $partial_name = "auction_outbid";
                break;
            case "Bookmarked Auction":
                $partial_name = "bookmarked_auction";
                break;
            case "Created Auction":
                $partial_name = "created_auction";
                break;
        }

        return view("partials.notifications." . $partial_name, [
            "auction" => $this->auction
        ]);
    }
}
