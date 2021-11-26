<?php

namespace App\Domain\Stock\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'category_id'	=> 'required|integer',
            'name' 			=> 'required|string|unique:products,name,' . $this->product,
            'description'	=> 'required|string',
            'min_quantity'	=> 'required|integer',
            'unit'			=> 'string|in:piece,grammes,litre,sachet',
        ];
    }
}