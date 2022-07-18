<?php

namespace App\Features;

use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Lucid\Units\Feature;

class ListItemsFeature extends Feature
{
    public function handle(Request $request)
    {
        $cart = $this->run(new FindCartByCustomerJob($request->route("customer_id")));

        $cartItems = $this->run(new CalculateSubtotalJob($cart));

        $cart->refresh();

        return Response::json(
            [
                "code" => 200,
                "message" => "Showing items in the cart.",
                "data" => [
                    "items" => $cartItems["products"],
                    "subtotal_amount" => $cart->subtotal_amount,
                ],
            ],
            200
        );
    }
}
