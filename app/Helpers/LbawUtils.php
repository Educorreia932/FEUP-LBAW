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

    // https://stackoverflow.com/questions/2955251/php-function-to-make-slug-url-string
    public static function slugify($text, string $divider = '-')
    {
        // replace non letter or digits by divider
        $text = preg_replace('~[^\pL\d]+~u', $divider, $text);

        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, $divider);

        // remove duplicate divider
        $text = preg_replace('~-+~', $divider, $text);

        // lowercase
        $text = strtolower($text);

        if (empty($text)) {
            return 'n-a';
        }

        return $text;
    }

}
