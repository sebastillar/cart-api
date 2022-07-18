<?php

namespace App\Domains\Cart\Jobs;

use App\Data\Models\Cart;
use App\Domains\Cart\DTOs\EmptyCartDTO;
use Lucid\Units\Job;

class CheckIsEmptyJob extends Job
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
     * @return bool
     */
    public function handle()
    {
        $itemsWithProducts = $this->cart
            ->items()
            ->with("product")
            ->get()
            ->toArray();

        return count($itemsWithProducts) === 0;
    }
}
