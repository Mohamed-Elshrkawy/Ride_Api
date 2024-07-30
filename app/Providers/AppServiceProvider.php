<?php

namespace App\Providers;

use App\Models\Car;
use App\Models\User;
use App\Observers\UserApp\CarObserver;
use App\Observers\UserApp\ProfileObserver;
use App\Services\SmsService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(SmsService::class, function ($app) {
            return new SmsService();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        User::observe(ProfileObserver::class);
        Car::observe(CarObserver::class);
    }
}
