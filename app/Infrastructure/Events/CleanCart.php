<?php

namespace App\Infrastructure\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CleanCart
{
    use Dispatchable, InteractsWithSockets, SerializesModels;
}