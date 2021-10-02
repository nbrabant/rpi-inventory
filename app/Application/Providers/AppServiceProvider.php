<?php

namespace App\Application\Providers;

use App\Domain\Cart\CartServiceProvider;
use App\Domain\Recipe\RecipeServiceProvider;
use App\Domain\Schedule\ScheduleServiceProvider;
use App\Domain\Stock\StockServiceProvider;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var DomainServiceProvider[] $providers
     */
    protected $providers = [
        CartServiceProvider::class,
        RecipeServiceProvider::class,
        ScheduleServiceProvider::class,
        StockServiceProvider::class,
    ];

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerProviders();
    }

    /**
     * Registering Service Provider.
     * @return void
     */
    protected function registerProviders()
    {
        foreach ($this->providers as $provider) {
            \App::register($provider);
        }
    }
}
