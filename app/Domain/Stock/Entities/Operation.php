<?php

namespace App\Domain\Stock\Entities;

use Illuminate\Database\Eloquent\Model as Eloquent;

class Operation extends Eloquent
{
    const INCREMENT_OPERATOR = '+';
    const DECREMENT_OPERATOR = '-';

    protected $table = 'operations';

    protected $fillable = [
        'product_id',
        'quantity',
        'operation',
        'detail'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function sumProductQuantity()
    {
        $operations = self::where('product_id', $this->product_id)->get();

        return array_reduce($operations, function ($sum, $operation) {
            if ($operation->operation === self::INCREMENT_OPERATOR) {
                return $sum + $operation->quantity;
            } else {
                return $sum - $operation->quantity;
            }
        }, 0);
    }
}
