<?php

namespace App\Features;

use App\Domains\Billing\Jobs\ServeBillingDataJob;
use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RespondWithJsonJob;
use App\Domains\Cart\Requests\Checkout;
use App\Domains\Order\Jobs\AddItemsToOrderJob;
use App\Domains\Order\Jobs\CreateOrderJob;
use App\Domains\Payment\Jobs\ServePaymentDataJob;
use App\Domains\Shipment\Jobs\ServeShipmentDataJob;
use App\Domains\Status\Enums\OrderStatusesEnums;
use App\Domains\Status\Jobs\UpdateOrderStatusJob;
use App\Http\Resources\OrderResource;
use Lucid\Units\Feature;

class CheckoutFeature extends Feature
{
    public function handle(Checkout $request)
    {
        $params = $request->validated();
        $cart = $this->run(new FindCartByCustomerJob($params["customer_id"]));
        $orderPaid = 0;

        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        $message = "Checkout in progress...";

        if (!$isEmpty) {
            $order = $this->run(new CreateOrderJob($cart));
            $orderWithItems = $this->run(new AddItemsToOrderJob($cart, $order));
            $this->run(new UpdateOrderStatusJob($order, OrderStatusesEnums::STATUS_CHECKOUT));
            $orderShippable = $this->run(new ServeShipmentDataJob($order));
            $orderBillable = $this->run(new ServeBillingDataJob($order));
            $orderPaid = $this->run(new ServePaymentDataJob($order));

            if ($orderPaid->payment_status === 1) {
                $this->run(new UpdateOrderStatusJob($order, OrderStatusesEnums::STATUS_COMPLETED));
                $message = "Order placed successfully";
            } else {
                $this->run(new UpdateOrderStatusJob($order, OrderStatusesEnums::STATUS_CANCELLED));
                $message = "Order was cancelled.";
            }
        }

        $cartEmpty = $this->run(new CalculateSubtotalJob($cart));

        $results = [
            "message" => $message,
            "data" => new OrderResource($orderPaid),
        ];

        return $this->run(new RespondWithJsonJob($cart, $results, $isEmpty));
    }
}
