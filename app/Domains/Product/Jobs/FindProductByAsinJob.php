<?php

namespace App\Domains\Product\Jobs;

use App\Interfaces\EloquentRepositoryInterface;
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
     * @return void
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        return $repository->findBy("asin", $this->asin);
    }
}
