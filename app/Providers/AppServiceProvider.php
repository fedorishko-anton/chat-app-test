<?php

namespace App\Providers;

use App\Repositories\ChatRepository\ChatRepository;
use App\Repositories\ChatRepository\ChatRepositoryInterface;
use App\Repositories\UserRepository\UserRepository;
use App\Repositories\UserRepository\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
      $this->app->bind(
        UserRepositoryInterface::class,
        UserRepository::class
      );
      $this->app->bind(
        ChatRepositoryInterface::class,
        ChatRepository::class
      );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
