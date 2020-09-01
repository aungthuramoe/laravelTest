<?php

namespace App\Providers;

use App\Contracts\Dao\Post\PostDaoInterface;
use App\Contracts\Dao\User\UserDaoInterface;
use App\Contracts\Services\Post\PostServiceInterface;
use App\Contracts\Services\User\UserServiceInterface;
use App\Dao\Post\PostDao;
use App\Dao\User\UserDao;
use App\Services\Post\PostService;
use App\Services\User\UserService;
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
        // Dao Registration
        $this->app->bind(UserDaoInterface::class, UserDao::class);
        $this->app->bind(PostDaoInterface::class, PostDao::class);

        // Business logic registration
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(PostServiceInterface::class, PostService::class);
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
