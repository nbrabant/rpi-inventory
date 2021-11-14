<?php

namespace App\Domain\Cart\Http\Controllers\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Infrastructure\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Domain\Cart\Mail\CartList;
use App\Domain\Cart\Services\CartQueryService;
use App\Domain\Cart\Services\CartCommandService;

class Carts extends Controller
{
    /**
     * @var CartQueryService $cartQueryService
     */
    private $cartQueryService;
    /**
     * @var CartCommandService $cartCommandService
     */
    private $cartCommandService;

    public function __construct(
        CartQueryService $cartQueryService,
        CartCommandService $cartCommandService
    ) {
        $this->cartQueryService = $cartQueryService;
        $this->cartCommandService = $cartCommandService;
    }

    public function pdf(Request $request)
    {
        $cart = $this->cartQueryService->getCurrent($request);

        $datas = [
            'title' => 'Liste de courses du ' . Carbon::now()->format('d/m/Y à H:i'),
            'productLines' => $cart->productLines
        ];

        $pdf = \PDF::loadView('pdf.exportliste', $datas);
        return $pdf->download('liste-courses.pdf');
    }

    public function mail(Request $request)
    {
        Mail::to('aurore.derumier@gmail.com')
            ->send(new CartList($this->cartQueryService->getCurrent($request)));

        return redirect('/#/carts/');
    }

    public function trello(Request $request)
    {
        $cart = $this->cartQueryService->getCurrent($request);

        $this->cartCommandService->updateTrelloCard($request, $cart->exportToTrello());

        return redirect('/#/carts/');
    }
}
