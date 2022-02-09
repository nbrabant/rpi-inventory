<?php

namespace App\Domain\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Cart\Http\Requests\Rules\IsInCart;

/**
 * @property int product_id
 */
class RemoveFromCartRequest extends FormRequest implements CartProductRequestInterface
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
        return 0;
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
     * @param IsInCart $isInCart
     * @return mixed[]
     */
    public function rules(IsInCart $isInCart): array
    {
        return [
            'product_id' => ['required', 'integer', $isInCart]
        ];
    }
}