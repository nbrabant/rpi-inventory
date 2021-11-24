<?php

namespace App\Domain\Cart\Mail;

use App\Domain\Cart\Contracts\CartInterface;
use App\Domain\Cart\Entities\ProductLine;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Carbon\Carbon;

class CartList extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var string $title
     */
    public string $title;
    /**
     * @var ProductLine $productLines
     */
    public $productLines;

    /**
     * Create a new message instance.
     *
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart)
    {
        $this->title = sprintf('Liste de courses du %s', Carbon::now()->format('d/m/Y à H:i'));
        $this->productLines = $cart->productLines;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build(): CartList
    {
        return $this->from( config('mail.username') )
                    ->view('pdf.exportliste');
    }
}
