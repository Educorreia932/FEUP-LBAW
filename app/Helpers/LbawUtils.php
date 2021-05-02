<?php
namespace App\Helpers;

class LbawUtils {
    public static function formatCurrency($val): string {
        return number_format($val / 100, 2);
    }
}
