<?php

namespace App\Http\Resources;

use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use JsonSerializable;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "subtotal USD" => $this->subtotal_amount,
            "Shipping and handler USD" => $this->shipment_amount,
            "Taxes USD" => $this->tax_amount,
            "Total USD" => $this->total_amount,
            "Shipping address" => $this->shipment_data,
            "Billing address" => $this->billing_data,
            "Payment status" => $this->payment_status,
            "items" => $this->items()
                ->with("product")
                ->get()
                ->toArray(),
        ];
    }
}
