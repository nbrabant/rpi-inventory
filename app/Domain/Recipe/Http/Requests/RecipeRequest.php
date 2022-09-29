<?php

namespace App\Domain\Recipe\Http\Requests;

use App\Domain\Recipe\Http\Requests\Rules\IsValidProductUnit;
use Illuminate\Foundation\Http\FormRequest;

/**
 * @property string name
 * @property string recipe_type
 * @property string number_people
 * @property int preparation_time
 * @property int cooking_time
 * @property string complement
 * @property mixed[] products
 * @property mixed[] steps
 */
class RecipeRequest extends FormRequest
{
    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getRecipeType(): string
    {
        return $this->recipe_type;
    }

    /**
     * @return int
     */
    public function getNumberPeople(): string
    {
        return $this->number_people;
    }

    /**
     * @return int
     */
    public function getPreparationTime(): int
    {
        return $this->preparation_time;
    }

    /**
     * @return int
     */
    public function getCookingTime(): int
    {
        return $this->cooking_time;
    }

    /**
     * @return string
     */
    public function getComplement(): ?string
    {
        return $this->complement;
    }

    /**
     * @return mixed[]
     */
    public function getProducts(): array
    {
        return $this->products;
    }

    /**
     * @return mixed[]
     */
    public function getSteps(): array
    {
        return $this->steps;
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
     * @param IsValidProductUnit $isValidProductUnit
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
