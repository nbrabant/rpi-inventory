<?php

namespace App\Application\Providers;

use App\Domain\Cart\Listeners\NotifyExportCart;
use App\Domain\Cart\Listeners\NotifyPurgeCart;
use App\Infrastructure\Events\CleanCart;
use App\Infrastructure\Events\ExportCart;
use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

use App\Domain\Stock\Services\Product\ProductCommandService as ProductCommandService;
use App\Domain\Stock\Repositories\ProductRepository as ProductRepository;
use App\Domain\Stock\Repositories\OperationRepository as OperationRepository;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CleanCart::class => [
            NotifyPurgeCart::class
        ],
        ExportCart::class => [
            NotifyExportCart::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        \App\Domain\Stock\Entities\Operation::created(function($operation) {
            $service = new ProductCommandService(new ProductRepository(app()), new OperationRepository(app()));
            $service->updateProductStockQuantity($operation->product_id);
        });

        \App\Domain\Cart\Entities\Cart::saved(function($cart) {
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
