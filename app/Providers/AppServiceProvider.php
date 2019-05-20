<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Libraries\Versioning\VersionControlInterface;
use App\Libraries\Versioning\VersionControl;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->register(\Tymon\JWTAuth\Providers\LumenServiceProvider::class);

        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }

        // Register App\Libraries\Versioning\VersionControlInterface::class
        $this->app->bind(VersionControlInterface::class, function ($app) {
            $request        = $app->make('request');
            $versionControl = new VersionControl($request);
            $config         = $app->make('config');

            // set properties
            $pattern = $config->get('api.accept_header_pattern');
            $versionControl->setAcceptHeaderPattern($pattern);
            $fallback = $config->get('api.fallback_version');
            $explode_uri = explode('/',$request->getRequestUri());
            if (preg_replace("/[^0-9]/", '', $explode_uri[1]) != $fallback) {
                $fallback = preg_replace("/[^0-9]/", '', $explode_uri[1]);
            }
            $versionControl->setFallbackVersion($fallback);

            return $versionControl;
        });
    }
}
