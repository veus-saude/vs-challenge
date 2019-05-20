<?php

namespace App\Providers;

use Auth;
use Illuminate\Events\Dispatcher;
use Illuminate\Support\ServiceProvider;
use JeroenNoten\LaravelAdminLte\Events\BuildingMenu;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(Dispatcher $events)
    {
        // https://laravel-news.com/laravel-5-4-key-too-long-error
        \Schema::defaultStringLength(191);

        // https://github.com/jeroennoten/Laravel-AdminLTE#menu-configuration-at-runtime
        $events->listen(BuildingMenu::class, function (BuildingMenu $event) {
            $event->menu->add('ACCOUNT SETTINGS');
            $event->menu->add([
                'text' => 'Profile',
                'url'  => 'users/' . Auth::id(),
                'icon' => 'user',
            ]);
        });
    }
}
