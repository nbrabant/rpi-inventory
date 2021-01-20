<?php

namespace App\Interfaces\Http\Controllers\Exports;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Interfaces\Http\Controllers\Controller;
use Carbon\Carbon;

use App\Domain\Cart\Mail\CartList;
use App\Domain\Cart\Services\CartQueryService;
use App\Domain\Cart\Services\CartCommandService;

class Carts extends Controller
{
    public function __construct(CartQueryService $cart_query_service, CartCommandService $cart_command_service)
    {
        $this->cart_query_service = $cart_query_service;
        $this->cart_command_service = $cart_command_service;
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
            ->send(new CartList($this->cart_query_service->getCurrent($request)));

        return redirect('/#/carts/');
    }

    public function trello(Request $request)
    {
        $cart = $this->cart_query_service->getCurrent($request);

        $this->cart_command_service->updateTrelloCard($request, $cart->exportToTrello());

        return redirect('/#/carts/');
    }
}
