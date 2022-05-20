<?php

namespace Hito\Auth;

use Hito\Auth\Providers\AppServiceProvider;
use Hito\Auth\Providers\RouteServiceProvider;
use Hito\Core\BaseServiceProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends BaseServiceProvider
{
    public function register()
    {
        app()->register(AppServiceProvider::class);
        app()->register(RouteServiceProvider::class);
    }

    public function boot()
    {
        $this->loadViewsFrom(__DIR__.'/../resources/views', 'hito-auth');
        $this->loadTranslationsFrom(__DIR__.'/../lang', 'hito-auth');

        $this->registerAssetDirectory('public', 'auth');
    }
}
