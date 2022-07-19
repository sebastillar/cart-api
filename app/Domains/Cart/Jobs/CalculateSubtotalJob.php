<?php

namespace App\Domains\Cart\Jobs;

use App\Data\Models\Cart;
use App\Domains\Item\DTOs\ItemAddedDTO;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class CalculateSubtotalJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Cart $cart)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Cart
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $subtotalAmount = $this->cart->items()->sum("subtotal_item");

        $repository->update($this->cart, ["subtotal_amount" => $subtotalAmount]);

        return $this->cart;
    }
}
