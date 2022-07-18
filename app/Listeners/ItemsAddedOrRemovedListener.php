<?php

namespace App\Listeners;

use App\Events\ItemsAddedOrRemoved;

class ItemsAddedOrRemovedListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param ItemsAddedOrRemoved $event
     * @return void
     */
    public function handle(ItemsAddedOrRemoved $event)
    {
    }
}
