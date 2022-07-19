<?php

namespace App\Domains\Item\Jobs;

use App\Data\Models\Item;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class IncreaseQuantityJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Item $item)
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
        $this->item->quantity++;
        $this->item->subtotal_item += $this->item->product->price;
        $repository->save($this->item);
    }
}
