<?php

namespace App\Providers;

use Str;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::middleware('web')
             ->namespace($this->namespace)
             ->group(base_path('routes/web.php'));
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        /*
         * Looping into route/api folder. The files must be named as 'vi.php', where i, should be the version of the api
         * which have the routes specified into the them. This code automatically keeps the routes on, to disable them
         * just remove the file from the route/api folder.
         */
        foreach (array_filter(array_diff(scandir(base_path('routes/api')), ['..', '.']), function ($value) {
            return Str::contains($value, '.php');
        }) as $api_routes_filename) {
            $api_version = Str::before($api_routes_filename, '.php');
            Route::prefix("api/$api_version")
                ->middleware(['api', 'auth:api'])
                ->namespace("{$this->namespace}\\Api\\" . strtoupper($api_version))
                ->group(base_path("routes/api/$api_routes_filename"));
        }
    }
}
