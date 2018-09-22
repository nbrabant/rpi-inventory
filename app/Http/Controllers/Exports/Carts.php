<?php

namespace App\Http\Controllers\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Mail\CartList;
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
        Mail::to('aurore.derumier@gmail.com')
            ->send( new CartList($this->cart_query_service->getCurrent($request)) );

        return redirect('/#/carts/');
    }

    public function trello(Request $request)
    {
        $cart = $this->cart_query_service->getCurrent($request);
        $cart->exportToTrello();

        return redirect('/#/carts/');
    }

}
