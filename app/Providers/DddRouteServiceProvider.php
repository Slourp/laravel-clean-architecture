<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

class DddRouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        /**
         * Define routes for the UserContext in the Domain layer.
         */
        /**
         * API routes for UserContext in the Domain layer.
         */
        Route::middleware('api')
            ->prefix('api/users')
            ->group(base_path('src/Domain/UserContext/Infrastructure/Routes/api.php'));

        /**
         * Web routes for UserContext in the Domain layer.
         */
        Route::middleware('web')
            ->prefix('users')
            ->group(base_path('src/Domain/UserContext/Infrastructure/Routes/web.php'));

        /**
         * Define routes for the Infrastructure layer.
         */
        /**
         * API routes defined in the Infrastructure layer.
         */
        Route::middleware('api')
            ->prefix('api')
            ->group(base_path('src/Infrastructure/Routes/api.php'));

        /**
         * Web routes defined in the Infrastructure layer.
         */
        Route::middleware('web')
            ->group(base_path('src/Infrastructure/Routes/web.php'));
    }
}
