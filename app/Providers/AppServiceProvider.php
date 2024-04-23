<?php

namespace App\Providers;

use App\Repositories\BlogUserRepository;
use App\Repositories\BlogUserRepositoryInterface;
use App\Repositories\PostRepository;
use App\Repositories\PostRepositoryInterface;
use App\Services\BlogUserService;
use App\Services\PostService;
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
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        // $this->app->bind(PostService::class, function($app){
        //     return new PostService($app->make(PostRepositoryInterface::class));
        // });
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
