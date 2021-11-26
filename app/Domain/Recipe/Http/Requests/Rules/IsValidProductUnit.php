<?php

namespace App\Domain\Recipe\Http\Requests\Rules;

use App\Domain\Recipe\Contracts\RecipeInterface;
use Illuminate\Contracts\Validation\Rule;

class IsValidProductUnit implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  string  $unit
     * @return bool
     */
    public function passes($attribute, $unit): bool
    {
        return in_array($unit, array_keys(RecipeInterface::UNITS_LIST));
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Cette unité n\'est pas référencée.';
    }
}