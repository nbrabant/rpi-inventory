<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Repositories\Cart\CartRepository as Cart;

class IsInCart implements Rule
{
    private $repository;
    
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = new Cart(app());
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
        return $this->repository->cartHasProduct($value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Ce produit n\'est pas dans la liste de courses.';
    }
}
