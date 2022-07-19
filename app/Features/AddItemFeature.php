<?php

namespace App\Features;

use App\Domains\Cart\Jobs\AddNewItemJob;
use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RespondWithJsonJob;
use App\Domains\Cart\Requests\AddItem;
use App\Domains\Item\Jobs\CreateItemJob;
use App\Domains\Item\Jobs\IncreaseQuantityJob;
use App\Domains\Product\Jobs\AssociateProductItemJob;
use App\Http\Resources\CartResource;
use App\Operations\FindOrCreateProductOperation;
use Lucid\Units\Feature;

class AddItemFeature extends Feature
{
    public function handle(AddItem $request)
    {
        $params = $request->validated();
        $qty = $params["item"]["quantity"];
        $customerId = $params["customer_id"];

        $cart = $this->run(new FindCartByCustomerJob($customerId));

        $product = $this->run(new FindOrCreateProductOperation($params, $request));

        $message = "This item already was in the cart.";

        if (!$cart->items->contains("product_id", $product->id)) {
            $item = $this->run(new CreateItemJob($qty));

            $productWithItem = $this->run(new AssociateProductItemJob($product, $item));

            $cartWithItem = $this->run(new AddNewItemJob($cart, $item));

            $message = "This item was added to the cart.";
        } else {
            $this->run(new IncreaseQuantityJob($cart->items->where("product_id", $product->id)->first()));
        }

        $cart = $this->run(new CalculateSubtotalJob($cart));

        $results = [
            "message" => $message,
            "data" => new CartResource($cart),
        ];

        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        return $this->run(new RespondWithJsonJob($cart, $results, $isEmpty));
    }
}
