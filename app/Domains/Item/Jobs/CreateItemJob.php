<?php

namespace App\Domains\Item\Jobs;

use App\Data\Models\Product;
use App\Domains\Item\DTOs\ItemDTO;
use App\Domains\Item\DTOs\ItemAddedDTO;
use App\Domains\Item\DTOs\ItemNotAdded;
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
    public function __construct(private ItemDTO $item)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @param EloquentRepositoryInterface $repository
     * @return ItemNotAdded|ItemAddedDTO
     * @throws Exception
     */
    public function handle(EloquentRepositoryInterface $repository): ItemNotAdded|ItemAddedDTO
    {
        try {
            $model = $repository->create($this->item->toArray());
            return new ItemAddedDTO($model->product->asin, $model->quantity, $model->id, $model->product->price);
        } catch (Exception $exception) {
            if ($exception->getCode() !== "23000") {
                throw $exception;
            }
        }
        return new ItemNotAdded();
    }
}
