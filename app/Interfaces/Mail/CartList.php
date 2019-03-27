<?php

namespace App\Interfaces\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

use Carbon\Carbon;

use App\Domain\Cart\Entities\Cart;

class CartList extends Mailable
{
    use Queueable, SerializesModels;

    public $title;

    public $productLines;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Cart $cart)
    {
        $this->title = 'Liste de courses du ' . Carbon::now()->format('d/m/Y à H:i');
        $this->productLines = $cart->productLines;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from( config('mail.username') )
                    ->view('pdf.exportliste');
    }
}
