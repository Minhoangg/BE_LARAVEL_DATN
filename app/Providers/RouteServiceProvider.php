<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;


class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';
    public const SYSTEM = '/admin';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->mapApiAdminRoutes();

        $this->mapApiClientRoutes();
    }

    protected function mapApiAdminRoutes()
    {
        $adminRoutesPath = base_path('routes/admin');

        if (File::isDirectory($adminRoutesPath)) {
            $routeFiles = File::allFiles($adminRoutesPath);

            foreach ($routeFiles as $routeFile) {
                Route::middleware('api')
                     ->prefix('api/admin')
                     ->name('admin.')
                     ->group($routeFile->getPathname());
            }
        }
    }

    protected function mapApiClientRoutes()
    {
        $adminRoutesPath = base_path('routes/client');

        if (File::isDirectory($adminRoutesPath)) {
            $routeFiles = File::allFiles($adminRoutesPath);

            foreach ($routeFiles as $routeFile) {
                Route::middleware('api')
                     ->prefix('api/client')
                     ->name('client.')
                     ->group($routeFile->getPathname());
            }
        }
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
