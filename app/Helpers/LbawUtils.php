<?php
namespace App\Helpers;

use App\Models\Auction;

class LbawUtils {

    public static function formatCurrency($val): string {
        return number_format($val / 100, 2);
    }

    public static function encodeUsername(Auction $auction, int $bidder_id): string {
        $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

        srand($auction->id + $bidder_id * $auction->seller_id);

        $a = $characters[rand(0, strlen($characters) - 1)];
        $b = $characters[rand(0, strlen($characters) - 1)];

        return $a . '****' . $b;
    }

}
