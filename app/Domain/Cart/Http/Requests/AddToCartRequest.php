<?php

namespace App\Domain\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Cart\Http\Requests\Rules\NotInCart;

/**
 * @property int product_id
 * @property int quantity
 */
class AddToCartRequest extends FormRequest implements CartProductRequestInterface
{
    /**
     * @inheritDoc
     */
    public function getProductId(): int
    {
        return $this->product_id;
    }

    /**
     * @inheritDoc
     */
    public function getQuantity(): int
    {
        return $this->quantity;
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param NotInCart $notInCart
     * @return mixed[]
     */
    public function rules(NotInCart $notInCart): array
    {
        return [
            'product_id' => ['required', 'integer', $notInCart],
            'quantity' => 'required|integer'
        ];
    }
}