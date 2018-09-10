<?php

namespace App\Http\Controllers\Exports;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Services\Cart\CartQueryService;

class Carts extends Controller
{
    public function __construct(CartQueryService $cart_query_service)
    {
        $this->cart_query_service = $cart_query_service;
    }

    public function pdf(Request $request)
    {
        $cart = $this->cart_query_service->getCurrent($request);

        $datas = [
			'title' => 'Liste de courses du ' . Carbon::now()->format('d/m/Y à H:i'),
			'productLines' => $cart->productLines
		];

        $pdf = \PDF::loadView('pdf.exportliste', $datas);
		return $pdf->download('liste-courses.pdf');
    }

    public function mail(Request $request)
    {
        return 'mail';
    }

    public function trello(Request $request)
    {
        return 'trello';
    }

}
