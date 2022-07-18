<?php

namespace App\Listeners;

use App\Data\Models\Cart;
use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use Illuminate\Queue\InteractsWithQueue;

class CartRetrievedListener
{
    use InteractsWithQueue;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(private Cart $cart)
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle($event)
    {
        dd($event);
    }
}
