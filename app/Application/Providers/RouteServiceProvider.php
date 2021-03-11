<?php

namespace App\Application\Providers;

use App\Domain\Cart\CartServiceProvider;
use App\Domain\Recipe\RecipeServiceProvider;
use App\Domain\Schedule\ScheduleServiceProvider;
use App\Domain\Stock\StockServiceProvider;
use App\Infrastructure\Contracts\Provider\RouteProviderInterface;
use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * @var RouteProviderInterface[] $providers
     */
    protected $providers = [
        CartServiceProvider::class,
        RecipeServiceProvider::class,
        ScheduleServiceProvider::class,
        StockServiceProvider::class,
    ];

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapApiRoutes();

        $this->mapWebRoutes();
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        foreach ($this->providers as $provider) {
            Route::middleware('web')
                 ->namespace($provider::getWebNamespace())
                 ->group(base_path('routes/web.php'));
        }
    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        foreach ($this->providers as $provider) {
            Route::prefix('api')
                 ->middleware('api')
                 ->namespace($provider::getApiNamespace())
                 ->group(base_path('routes/api.php'));
        }
    }
}
