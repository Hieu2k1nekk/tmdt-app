<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Services\LanguageService;
use App\Services\Interfaces\LanguageServiceInterface;
use App\Repositories\LanguageRepository;
use App\Repositories\Interfaces\LanguageRepositoryInterface;
use App\Services\UserService;
use App\Services\Interfaces\UserServiceInterface;
use Illuminate\Support\Facades\Schema;


class AppServiceProvider extends ServiceProvider
{
    public $serviceBindings = [
        'App\Services\Interfaces\UserServiceInterface' => 'App\Services\UserService',
        'App\Services\Interfaces\LanguageServiceInterface' => 'App\Services\LanguageService',
        'App\Repositories\Interfaces\UserRepositoryInterface' => 'App\Repositories\UserRepository',
        'App\Repositories\Interfaces\BaseRepositoryInterface' => 'App\Repositories\BaseRepository',
        'App\Repositories\Interfaces\LanguageRepositoryInterface' => 'App\Repositories\LanguageRepository',
    ];

    /**
     * Register any application services.
     */

    public function register(): void
    {
        foreach ($this->serviceBindings as $key => $val) {
            $this->app->bind($key, $val);
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Schema::defaultStringLength(191);
    }
}
