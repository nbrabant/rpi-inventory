<?php

namespace App\Application\Providers;

use App\Domain\Cart\Events\CartFinished;
use App\Domain\Cart\Listeners\NotifyExportCart;
use App\Domain\Cart\Listeners\NotifyPurgeCart;
use App\Domain\Schedule\Events\CleanCart;
use App\Domain\Schedule\Events\ExportCart;
use App\Domain\Stock\Events\OperationCreating;
use App\Domain\Stock\Listeners\RegisterOperations;
use App\Domain\Stock\Listeners\UpdateStockQuantity;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

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
        ],
        OperationCreating::class => [
            UpdateStockQuantity::class
        ],
        CartFinished::class => [
            RegisterOperations::class
        ]
    ];
}
