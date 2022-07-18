<?php

namespace App\Domains\Cart\Jobs;

use App\Data\Models\Cart;
use App\Domains\Item\DTOs\ItemRemovedDTO;
use App\Interfaces\EloquentRepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lucid\Units\Job;

class RemoveItemFromCartJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Cart $cart, private int $itemId)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return ItemRemovedDTO
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $message = "Item was not in the cart.";
        try {
            $item = $repository->find($this->itemId);
            $inCart = $this->cart->items->contains($item);
            if ($inCart) {
                $message = sprintf("Item %s was removed", $this->itemId);
                return new ItemRemovedDTO($message, $repository->destroy($item->id));
            }
            return new ItemRemovedDTO($message, false);
        } catch (ModelNotFoundException $exception) {
            return new ItemRemovedDTO($message, false);
        }
    }
}
