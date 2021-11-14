<?php

namespace App\Domain\Recipe\Requests;

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
     * @return array
     */
    public function rules(): array
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
            // @TODO : define validation rule for product unit?
            'products.*.unit'       => 'nullable|string|in:grammes,litre,centilitre,cuilliere_cafe,cuilliere_dessert,cuilliere_soupe,verre_liqueur,verre_moutarde,grand_verre,tasse_cafe,bol,sachet,gousse',
            'steps.*.id'            => 'nullable|integer',
            'steps.*.name'          => 'string',
            'steps.*.instruction'   => 'string',
            'steps.*.position'      => 'integer|max:255',
        ];
    }
}
