<?php

namespace App\Domain\Cart\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Cart\Repositories\CartRepository as Cart;

class NotInCart implements Rule
{
    private $_repository;

    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->_repository = new Cart(app());
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return !$this->_repository->cartHasProduct($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ce produit est déjà dans la liste de courses.';
    }
}
