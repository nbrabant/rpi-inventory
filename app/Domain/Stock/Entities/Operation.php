<?php

namespace App\Domain\Stock\Entities;

use App\Domain\Stock\Contracts\OperationInterface;
use App\Domain\Stock\Contracts\ProductInterface;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Operation extends Eloquent implements OperationInterface
{
    /**
     * @var string $table
     */
    protected $table = 'operations';

    /**
     * @var string[] $fillable
     */
    protected $fillable = [
        'product_id',
        'quantity',
        'operation',
        'detail'
    ];

    /**
     * @return BelongsTo
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * @return int
     */
    public function sumProductQuantity(): int
    {
        /** @var OperationInterface $operations */
        $operations = self::where('product_id', $this->product_id)->get();

        return array_reduce($operations, function ($sum, $operation) {
            if ($operation->operation === self::INCREMENT_OPERATOR) {
                return $sum + $operation->quantity;
            }
            return $sum - $operation->quantity;
        }, 0);
    }
}
