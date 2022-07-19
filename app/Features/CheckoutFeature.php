<?php

namespace App\Features;

use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RespondWithJsonJob;
use App\Domains\Cart\Requests\Checkout;
use App\Domains\Order\Jobs\AddItemsToOrderJob;
use App\Domains\Order\Jobs\CreateOrderJob;
use Lucid\Units\Feature;

class CheckoutFeature extends Feature
{
    public function handle(Checkout $request)
    {
        $params = $request->validated();
        $cart = $this->run(new FindCartByCustomerJob($params["customer_id"]));

        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        if (!$isEmpty) {
            $order = $this->run(new CreateOrderJob($cart));
            $order = $this->run(new AddItemsToOrderJob($cart, $order));
        }
        $this->run(new CalculateSubtotalJob($cart));

        $results = [
            "message" => "",
            "data" => [],
        ];

        return $this->run(new RespondWithJsonJob($cart, $results, $isEmpty));
    }
}
