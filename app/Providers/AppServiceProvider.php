<?php

namespace App\Providers;

use App\Repositories\BlogUserRepository;
use App\Repositories\BlogUserRepositoryInterface;
use App\Services\BlogUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(BlogUserRepositoryInterface::class, BlogUserRepository::class);
        $this->app->bind(BlogUserService::class, function($app){
            return new BlogUserService($app->make(BlogUserRepositoryInterface::class));
        });
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
