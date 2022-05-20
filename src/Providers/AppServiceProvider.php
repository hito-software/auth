<?php

namespace Hito\Auth\Providers;

use Hito\Auth\Repositories\AuthRepository;
use Hito\Auth\Repositories\AuthRepositoryImpl;
use Hito\Auth\Services\AuthService;
use Hito\Auth\Services\AuthServiceImpl;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public array $bindings = [
        // Repositories
        AuthRepository::class => AuthRepositoryImpl::class,

        // Services
        AuthService::class => AuthServiceImpl::class
    ];

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
        //
    }
}
