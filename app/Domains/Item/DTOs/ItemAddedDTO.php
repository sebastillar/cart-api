<?php

namespace App\Domains\Item\DTOs;

use Illuminate\Database\Eloquent\Model;

class ItemAddedDTO
{
    const MESSAGE = "This item was added to cart.";
    private string $productId;
    private int $id;
    private int $quantity;

    public function __construct(protected Model $item)
    {
        $this->productId = $item->product->asin;
        $this->quantity = $item->quantity;
        $this->id = $item->id;
    }

    public function toArray()
    {
        return [
            "product_id" => $this->productId,
            "quantity" => $this->quantity,
            "id" => $this->id,
        ];
    }

    public function message(): string
    {
        return self::MESSAGE;
    }
}
