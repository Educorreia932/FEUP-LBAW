<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Paginator::useBootstrap();

        Blade::if('admin', function () {
            return Auth::guard('admin')->check();
        });

        // Debug
        Blade::directive('dump', function ($expression) {
            return "<?php dump({$expression}); ?>";
        });

        Blade::directive('dd', function ($expression) {
            return "<?php dd({$expression}); ?>";
        });

        // Helper Wrappers
        Blade::directive('currency', function ($expression) {
            return "<?= \App\Helpers\LbawUtils::formatCurrency($expression); ?>";
        });

        Blade::directive('encodeUsername', function ($expression) {
            list($auction, $user_id) = explode(', ', $expression);
            return "<?= \App\Helpers\LbawUtils::encodeUsername($auction, $user_id); ?>";
        });

        // Syntatic Sugary Goodness
        Blade::directive('profilepic', function ($expression) {
            if (str_contains($expression, ',')) {
                list($user, $type) = explode(', ', $expression);
            } else {
                $user = $expression;
                $type = 'small';
            }

            return "src='<?php echo($user)->getImage('$type') ?>' alt='<?php echo($user)->username; ?> profile picture' "
                . "onerror=\"this.onerror=null;this.src='<?php echo($user)->getDefaultImage('$type'); ?>'\"";
        });

        Blade::directive('auctionStatus', function($auction) {
            return ("<i style=\"font-size: 0.5em;\" "
            . "class=\"bi bi-circle-fill me-2 <?php echo {$auction}->ended ? 'text-danger' : ({$auction}->scheduled ? 'text-warning' : 'text-success'); ?>\" "
            . "data-bs-original-title=\"<?php echo {$auction}->ended ? 'Ended' : ({$auction}->scheduled ? 'Scheduled' : 'Open'); ?>\" "
            . "data-bs-toggle=\"tooltip\" title=\"\">"
            . "</i>");
        });
    }
}
