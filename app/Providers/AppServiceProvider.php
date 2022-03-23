<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\URL;
use Str;
use Config;


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
        Schema::defaultStringLength(191);

        if(!$this->app->environment('production')) {
            URL::forceRootUrl(Config::get('app.url'));
            if (Str::contains(Config::get('app.url'), 'https://')) {
                // URL::forceScheme('https');
                URL::forceScheme('https');
            }
        }

        URL::forceScheme('https');
    }
}
