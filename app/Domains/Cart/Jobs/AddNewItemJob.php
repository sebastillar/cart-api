<?php

namespace App\Domains\Cart\Jobs;

use App\Data\Models\Cart;
use App\Data\Models\Item;
use App\Interfaces\EloquentAssociateRepository;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class AddNewItemJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Cart $cart, private Item $item)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    /**
     * Execute the job.
     *
     * @return Model
     */
    public function handle(EloquentAssociateRepository $repository)
    {
        return $repository->associateItem($this->cart, $this->item);
    }
}
