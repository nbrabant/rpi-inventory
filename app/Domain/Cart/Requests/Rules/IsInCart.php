<?php

namespace App\Domain\Cart\Requests\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\Domain\Cart\Contracts\CartRepositoryInterface;

/**
 * @property CartRepositoryInterface $cartRepository
 */
class IsInCart implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $productId
     * @return bool
     */
    public function passes($attribute, $productId): bool
    {
        return $this->cartRepository->cartHasProduct($productId);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message(): string
    {
        return 'Ce produit n\'est pas dans la liste de courses.';
    }

}
