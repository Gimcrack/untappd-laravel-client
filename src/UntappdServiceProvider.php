<?php

namespace Ingenious\Untappd;

use Ingenious\Untappd\Untappd;
use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class UntappdServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        // config
        $this->publishes([
            __DIR__.'/config/untappd.php' => config_path('untappd.php')
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('Untappd', function() {
            return new Untappd;
        } );
    }
}
