<?php

namespace App\Domains\Item\Jobs;

use App\Interfaces\EloquentRepositoryInterface;
use Exception;
use Illuminate\Database\Eloquent\Model;
use Lucid\Units\Job;

class CreateItemJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(protected int $quantity)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param EloquentRepositoryInterface $repository
     * @return Model
     * @throws Exception
     */
    public function handle(EloquentRepositoryInterface $repository): Model
    {
        $item = null;
        try {
            $item = $repository->create(["quantity" => $this->quantity]);
        } catch (Exception $exception) {
            if ($exception->getCode() !== "23000") {
                throw $exception;
            }
        }
        return $item;
    }
}
