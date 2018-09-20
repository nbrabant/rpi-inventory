<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Services\Stock\Product\ProductCommandService as ProductCommandService;
use App\Repositories\Stock\ProductRepository as ProductRepository;
use App\Repositories\Stock\OperationRepository as OperationRepository;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        // 'App\Events\Operation' => [
        //     'App\Listeners\EventListener',
        // ],
        // 'App\Events\CartlistSaving' => [
        //     'App\Listeners\CartlistUpdating',
        // ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        \App\Models\Operation::created(function($operation) {
            $service = new ProductCommandService(new ProductRepository(app()), new OperationRepository(app()));
            $service->updateProductStockQuantity($operation->product_id);
        });

        \App\Models\Cart::saved(function($cart) {
            if (!$cart->finished || $cart->getOriginal('finished')) {
                return true;
            }

            $service = new ProductCommandService(new ProductRepository(app()), new OperationRepository(app()));
            $cart->productLines->each(function($product) use($service) {
                $service->createOperation([
                    'product_id'    => $product->product_id,
                    'quantity'      => $product->quantity,
                    'operation'     => '+',
                    'detail'        => 'Retour de courses du ' . \Carbon\Carbon::now()->format('d/m/Y'),
                ]);
            });
        });
    }
}
