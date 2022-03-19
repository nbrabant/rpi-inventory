<?php

namespace App\Domain\Cart\Http\Controllers\Exports;

use App\Domain\Schedule\Http\Requests\ExportToCartRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Redirector;
use Illuminate\Support\Facades\Mail;
use App\Infrastructure\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Domain\Cart\Mail\CartList;
use App\Domain\Cart\Services\CartQueryService;
use App\Domain\Cart\Services\CartCommandService;
use PDF;

class Carts extends Controller
{
    /**
     * @var CartQueryService $cartQueryService
     */
    private CartQueryService $cartQueryService;
    /**
     * @var CartCommandService $cartCommandService
     */
    private CartCommandService $cartCommandService;

    /**
     * @param CartQueryService $cartQueryService
     * @param CartCommandService $cartCommandService
     */
    public function __construct(
        CartQueryService $cartQueryService,
        CartCommandService $cartCommandService
    ) {
        $this->cartQueryService = $cartQueryService;
        $this->cartCommandService = $cartCommandService;
    }

    /**
     * @param Request $request
     * @return Response
     */
    public function pdf(Request $request): Response
    {
        $cart = $this->cartQueryService->getCurrent($request);

        $datas = [
            'title' => 'Liste de courses du ' . Carbon::now()->format('d/m/Y à H:i'),
            'productLines' => $cart->productLines
        ];

        /** @var \Barryvdh\DomPDF\PDF $pdf */
        $pdf = PDF::loadView('pdf.exportliste', $datas);
        return $pdf->download('liste-courses.pdf');
    }

    /**
     * @param Request $request
     * @return Redirector
     */
    public function mail(Request $request): Redirector
    {
        Mail::to('aurore.derumier@gmail.com')
            ->send(new CartList($this->cartQueryService->getCurrent($request)));

        return redirect('/#/carts/');
    }

    /**
     * @param ExportToCartRequest $request
     * @return Redirector
     */
    public function trello(ExportToCartRequest $request): Redirector
    {
        $cart = $this->cartQueryService->getCurrent();

        $this->cartCommandService->updateTrelloCard($request, $cart->exportToTrello());

        return redirect('/#/carts/');
    }
}
