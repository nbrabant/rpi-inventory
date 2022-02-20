<?php

namespace App\Domain\Cart\Listeners;

use App\Domain\Cart\Contracts\CartRepositoryInterface;

class NotifyPurgeCart
{
    /**
     * @var CartRepositoryInterface
     */
    private CartRepositoryInterface $cartRepository;

    /**
     * NotifyPurgeCart constructor.
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function handle(): void
    {
        $this->cartRepository->purgeCart();
    }
}