<?php

namespace App\Domains\Order\Jobs;

use App\Data\Models\Cart;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class CreateOrderJob extends Job
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
     * @return void
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $order = $repository->create([
            "customer_id" => $this->cart->customer_id,
        ]);
    }
}
