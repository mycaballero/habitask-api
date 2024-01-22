<?php

namespace App\Providers;

use App\Http\Repositories\ProviderToken\Impl\ProviderTokenRepositoryImpl;
use App\Http\Repositories\ProviderToken\ProviderTokenRepository;
use App\Http\Repositories\User\Impl\UserRepositoryImpl;
use App\Http\Repositories\User\UserRepository;
use App\Http\Services\Auth\AuthService;
use App\Http\Services\Auth\Impl\AuthServiceImpl;
use App\Http\Services\Auth\Impl\OAuthServiceImpl;
use App\Http\Services\Auth\OAuthService;
use App\Http\Services\ProviderToken\Impl\ProviderTokenServiceImpl;
use App\Http\Services\ProviderToken\ProviderTokenService;
use App\Http\Services\User\Impl\UserServiceImpl;
use App\Http\Services\User\UserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // Services
        $this->app->bind(OAuthService::class, OAuthServiceImpl::class);
        $this->app->bind(AuthService::class, AuthServiceImpl::class);
        $this->app->bind(ProviderTokenService::class, ProviderTokenServiceImpl::class);
        $this->app->bind(UserService::class, UserServiceImpl::class);

        // Repositories
        $this->app->bind(UserRepository::class, UserRepositoryImpl::class);
        $this->app->bind(ProviderTokenRepository::class, ProviderTokenRepositoryImpl::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
