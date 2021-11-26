<?php

namespace App\Domain\Cart\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Cart\Http\Requests\Rules\NotInCart;

class AddToCartRequest extends FormRequest
{
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