<?php

namespace App\Domain\Cart\Http\Resources;

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
    public function __construct(
        CartCommandService $cartCommandService,
        CartQueryService $cartQueryService
    ) {
        $this->cartCommandService = $cartCommandService;
        $this->cartQueryService = $cartQueryService;
    }

    public function show(Request $request, $id)
    {
        return $this->cartQueryService->getCurrent($request);
    }

    public function update(FinishedCartRequest $request, $id)
    {
        return $this->cartCommandService->updateCart($request);
    }
}
