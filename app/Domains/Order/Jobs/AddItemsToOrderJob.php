<?php

namespace App\Domains\Order\Jobs;

use App\Data\Models\Cart;
use App\Data\Models\Order;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class AddItemsToOrderJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Cart $cart, private Order $order)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Order
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $itemsWithProducts = $this->cart->items()->get();
        $this->order->items()->saveMany($itemsWithProducts);
        $this->order->update(["subtotal_amount" => $this->cart->subtotal_amount]);
        return $this->order;
    }
}
