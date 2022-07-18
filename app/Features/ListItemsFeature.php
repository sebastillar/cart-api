<?php

namespace App\Features;

use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RespondWithJsonJob;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class ListItemsFeature extends Feature
{
    public function handle(Request $request)
    {
        $cart = $this->run(new FindCartByCustomerJob($request->route("customer_id")));

        $cartItems = $this->run(new CalculateSubtotalJob($cart));

        $cart->refresh();

        $results = [
            "message" => "Showing items in the cart.",
            "data" => [
                "items" => $cartItems["products"],
                "subtotal_amount" => $cart->subtotal_amount,
            ],
        ];

        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        return $this->run(new RespondWithJsonJob($cart, $results, $isEmpty));
    }
}
