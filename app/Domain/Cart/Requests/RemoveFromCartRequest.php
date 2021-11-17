<?php

namespace App\Domain\Cart\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Domain\Cart\Requests\Rules\IsInCart;

class RemoveFromCartRequest extends FormRequest
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
     * @return array
     */
    public function rules(): array
    {
        return [
            'product_id' => ['required', 'integer', new IsInCart]
        ];
    }
}