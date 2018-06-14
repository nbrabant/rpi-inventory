<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Services\Stock\Product\ProductCommandService as ProductCommandService;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Operation' => [
            'App\Listeners\EventListener',
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        // \App\Models\Operation::created(function($operation) {
        //     $service = new ProductCommandService();
        //     $service->updateProductStockQuantity($operation->product_id);
        // });
    }
}
