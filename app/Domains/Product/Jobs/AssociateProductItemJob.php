<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Item;
use App\Data\Models\Product;
use App\Interfaces\EloquentAssociateRepository;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class AssociateProductItemJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Product $product, private Item $item)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return Model
     */
    public function handle(EloquentAssociateRepository $repository)
    {
        return $repository->associateItem($this->product, $this->item);
    }
}
