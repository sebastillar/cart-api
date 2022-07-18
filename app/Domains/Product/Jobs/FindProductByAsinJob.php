<?php

namespace App\Domains\Product\Jobs;

use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class FindProductByAsinJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $asin)
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
        return $repository->findBy("asin", $this->asin);
    }
}
