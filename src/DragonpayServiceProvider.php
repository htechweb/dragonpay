<?php

namespace Htech\Dragonpay;
use Illuminate\Support\ServiceProvider;

class DragonpayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->make('Htech\Dragonpay\Controllers\DragonpayController');
        $this->mergeConfigFrom(
            __DIR__.'/config/dragonpay.php', 'dragonpay'
        );
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/examples/routes.php');
        // $this->loadMigrationsFrom(__DIR__.'/migrations');
        // $this->loadViewsFrom(__DIR__.'/views', 'dragonpay');
        $this->publishes([
            __DIR__.'/examples/views'       => resource_path('views/htech/dragonpay'),
            __DIR__.'/examples/assets'      => public_path('dragonpay'),
            __DIR__.'/examples/migrations'  => database_path('migrations'),
            __DIR__.'/examples/Controllers/DragonpayController.php' => app_path('Http/Controllers/DragonpayController.php'),
        ],'dp-examples');

        $this->publishes([
            __DIR__.'/config/dragonpay.php'       => config_path('dragonpay.php'),
        ],'dp-config');
    }
}
