<?php

namespace App\Domain\Recipe\Http\Requests;

use App\Domain\Recipe\Http\Requests\Rules\IsValidProductUnit;
use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
    public function rules(IsValidProductUnit $isValidProductUnit): array
    {
        return [
            'name'                  => 'required|string',
            'recipe_type'           => 'required|in:entrée,plat,dessert',
            'number_people'         => 'required|string|max:64',
            'preparation_time'      => 'integer',
            'cooking_time'          => 'integer',
            'complement'            => 'nullable|string',
            'products.*.product_id' => 'integer',
            'products.*.quantity'   => 'integer',
            'products.*.unit'       => ['nullable', 'string', $isValidProductUnit],
            'steps.*.id'            => 'nullable|integer',
            'steps.*.name'          => 'string',
            'steps.*.instruction'   => 'string',
            'steps.*.position'      => 'integer|max:255',
        ];
    }
}
