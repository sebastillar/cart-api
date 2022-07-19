<?php

namespace App\Domains\Cart\Jobs;

use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class FindCartByCustomerJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private int $cartId)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Model
     */
    public function handle(EloquentRepositoryInterface $repository): Model
    {
        return $repository->findBy("customer_id", $this->cartId);
    }
}
