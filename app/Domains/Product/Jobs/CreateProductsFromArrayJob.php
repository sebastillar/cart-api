<?php

namespace App\Domains\Product\Jobs;

use App\Data\Models\Product;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class CreateProductsFromArrayJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private array $products, private string $maxQtyToCreate)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return array|Product[]
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $this->products = $this->products["content"]["offers"];

        if (count($this->products) > $this->maxQtyToCreate) {
            $this->products = array_slice($this->products, 0, $this->maxQtyToCreate);
        }

        $products = array_map(function ($item) {
            return [
                "name" => $item["name"],
                "asin" => $item["asin"],
                "price" => $item["price"],
                "link" => $item["link"],
            ];
        }, $this->products);

        return tap($products, function () use ($products, $repository) {
            $repository->update($products);
        });
    }
}
