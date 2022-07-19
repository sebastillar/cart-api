<?php

namespace App\Domains\Order\Jobs;

use App\Data\Models\Cart;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
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
     * @return Model
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        return $repository->create([
            "customer_id" => $this->cart->customer_id,
        ]);
    }
}
