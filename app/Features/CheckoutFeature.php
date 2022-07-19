<?php

namespace App\Features;

use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Order\Jobs\CreateOrderJob;
use Illuminate\Http\Request;
use Lucid\Units\Feature;

class CheckoutFeature extends Feature
{
    public function handle(Request $request)
    {
        $params = $request->validated();

        $cart = $this->run(new FindCartByCustomerJob($params["customer_id"]));

        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        if (!$isEmpty) {
            $cart = $this->run(new CreateOrderJob($cart));
        }
    }
}
