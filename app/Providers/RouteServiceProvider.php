<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/init_redirect';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });

        $this->configureRoutes();
    }

    /**
     * Configure the routes offered by the application.
     *
     * Here we are including our panel.php file.
     */
    private function configureRoutes(): void
    {
        $this->routes(function () {
            // Existing routes registration...
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            // Adding our custom panel routes
            Route::middleware('web')  // Apply 'web' middleware
                ->prefix('panel')
                ->group(base_path('routes/panel.php'));  // Pointing to our panel routes file
        });
    }
}
