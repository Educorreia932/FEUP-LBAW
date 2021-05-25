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

        Blade::directive('currency', function ($expression) {
            return "<?= \App\Helpers\LbawUtils::formatCurrency($expression) ?>";
        });

        Blade::directive('encodeUsername', function ($expression) {
            list($auction, $user_id) = explode(', ', $expression);
            return "<?= \App\Helpers\LbawUtils::encodeUsername($auction, $user_id) ?>";
        });

        Blade::directive('profilepic', function ($expression) {

            if (str_contains($expression, ',')) {
                list($user, $type) = explode(', ', $expression);
            } else {
                $user = $expression;
                $type = 'small';
            }

            return "src='<?php echo($user)->getImage('$type') ?>' alt='<?php echo($user)->username; ?> profile picture' "
                . "onerror=\"this.onerror=null;this.src='<?php echo($user)->getDefaultImage('$type') ?>'\"";
        });

    }
}
