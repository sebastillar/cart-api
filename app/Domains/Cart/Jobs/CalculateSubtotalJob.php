<?php

namespace App\Domains\Cart\Jobs;

use App\Data\Models\Cart;
use App\Domains\Item\DTOs\ItemAddedDTO;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class CalculateSubtotalJob extends Job
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
     * @return array
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $itemsWithProducts = $this->cart
            ->items()
            ->with("product")
            ->get()
            ->toArray();

        $products = [];
        $subtotalAmount = 0;

        foreach ($itemsWithProducts as $value) {
            $itemAdded = new ItemAddedDTO(
                $value["product"]["asin"],
                $value["quantity"],
                $value["id"],
                $value["product"]["price"]
            );

            $products[] = $itemAdded->toArray();
            $subtotalAmount += $value["quantity"] * $value["product"]["price"];
        }

        $cart["products"] = $products;
        
        $repository->update($this->cart, ["subtotal_amount" => $subtotalAmount]);

        return $cart;
    }
}
