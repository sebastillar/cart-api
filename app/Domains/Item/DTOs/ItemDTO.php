<?php

namespace App\Domains\Item\DTOs;

use App\Data\Models\Cart;
use App\Data\Models\Product;

class ItemDTO
{
    public function __construct(private int $quantity, private Product $product, private Cart $cart)
    {
    }

    public function toArray()
    {
        return [
            "quantity" => $this->quantity,
            "product" => $this->product,
            "cart" => $this->cart,
        ];
    }
}
