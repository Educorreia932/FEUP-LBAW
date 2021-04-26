<?php
namespace App\Helpers;

use DateTime;

class LbawUtils {
    // https://stackoverflow.com/questions/1416697/converting-timestamp-to-time-ago-in-php-e-g-1-day-ago-2-days-ago
    public static function time_diff_string($diff, $short = true): array {
        $diff->w = floor($diff->d / 7);
        $diff->d -= $diff->w * 7;

        $string = array(
            'y' => 'year',
            'm' => 'month',
            'w' => 'week',
            'd' => 'day',
            'h' => 'hour',
            'i' => 'minute',
            's' => 'second',
        );
        foreach ($string as $k => &$v) {
            if ($diff->$k) {
                $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
            } else {
                unset($string[$k]);
            }
        }

        if ($short) $string = array_slice($string, 0, 1);
        return $string;
    }

    public static function time_elapsed_string($date, $short = true): string {
        $s = LbawUtils::time_diff_string(date_create()->diff($date), $short);
        return $s ? implode(', ', $s) . ' ago' : 'just now';
    }

    public static function formatCurrency($val): string {
        return number_format($val / 100, 2);
    }
}
