<?php

namespace App\Features;

use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RemoveItemFromCartJob;
use App\Domains\Cart\Jobs\RespondWithJsonJob;
use App\Domains\Cart\Requests\RemoveItem;
use Lucid\Units\Feature;

class RemoveItemFeature extends Feature
{
    public function handle(RemoveItem $request)
    {
        $params = $request->validated();

        $cart = $this->run(new FindCartByCustomerJob($params["customer_id"]));

        $itemRemoved = $this->run(new RemoveItemFromCartJob($cart, $params["item_id"]))->toArray();

        $cartItems = $this->run(new CalculateSubtotalJob($cart));

        $cart->refresh();

        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        $results = [
            "message" => $itemRemoved["message"],
            "data" => [
                "items" => $cartItems["products"],
                "subtotal_amount" => $cart->subtotal_amount,
            ],
        ];

        return $this->run(new RespondWithJsonJob($cart, $results, $isEmpty));
    }
}
