<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\URL;
use App\Helpers\ImageHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // Force HTTPS for all URLs in production
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        // Register image helper as a global helper for Blade views
        Blade::directive('imageWebp', function ($url) {
            return "<?php echo \\App\\Helpers\\ImageHelper::webpUrl({$url}); ?>";
        });

        Blade::directive('imageJpg', function ($url) {
            return "<?php echo \\App\\Helpers\\ImageHelper::jpgUrl({$url}); ?>";
        });

        Blade::directive('imageUrl', function ($expression) {
            return "<?php echo \\App\\Helpers\\ImageHelper::imageUrl({$expression}); ?>";
        });
    }
}
