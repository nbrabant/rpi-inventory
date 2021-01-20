<?php

namespace App\Domain\Cart\Mail;

use App\Domain\Cart\Contracts\CartInterface;
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

    public $productLines;

    /**
     * Create a new message instance.
     *
     * @param CartInterface $cart
     */
    public function __construct(CartInterface $cart)
    {
        $this->title = 'Liste de courses du ' . Carbon::now()->format('d/m/Y à H:i');
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
