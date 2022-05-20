<?php

namespace Hito\Auth;

use Hito\Auth\Providers\AppServiceProvider;
use Hito\Auth\Providers\RouteServiceProvider;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
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

        $files = app('files');

        var_dump('AUTH SERVICE PROVIDER [START]');
        $publicPath = public_path(config('app.asset_path') . '/' . config('app.asset_directory_main'));
        var_dump($publicPath);
        $destinationPath = "{$publicPath}/auth";
        if (!$files->isDirectory($destinationPath)) {
            $files->ensureDirectoryExists($publicPath);
            var_dump('DIRECTORY SHOULD EXIST');
            $files->link(__DIR__.'/../public', $destinationPath);
        }

        var_dump('AUTH SERVICE PROVIDER [STOP]');
    }
}
