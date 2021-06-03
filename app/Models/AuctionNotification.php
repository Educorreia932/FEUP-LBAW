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
}
