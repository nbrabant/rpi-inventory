<?php

namespace App\Domain\Cart\Http\Resources;

use App\Domain\Cart\Contracts\CartInterface;
use Illuminate\Http\Request;
use App\Infrastructure\Http\Controllers\Controller;

use App\Domain\Cart\Services\CartCommandService;
use App\Domain\Cart\Services\CartQueryService;
use App\Domain\Cart\Requests\FinishedCartRequest;

/**
 * @property CartCommandService cartCommandService
 * @property CartQueryService cartQueryService
 */
class Carts extends Controller
{
    /**
     * @param CartCommandService $cartCommandService
     * @param CartQueryService $cartQueryService
     */
    public function __construct(
        CartCommandService $cartCommandService,
        CartQueryService $cartQueryService
    ) {
        $this->cartCommandService = $cartCommandService;
        $this->cartQueryService = $cartQueryService;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return CartInterface
     */
    public function show(Request $request, int $id): CartInterface
    {
        return $this->cartQueryService->getCurrent($request);
    }

    /**
     * @param FinishedCartRequest $request
     * @param int $id
     * @return CartInterface
     */
    public function update(FinishedCartRequest $request, int $id): CartInterface
    {
        return $this->cartCommandService->updateCart($request);
    }
}
