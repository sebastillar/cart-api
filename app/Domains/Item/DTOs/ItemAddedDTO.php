<?php

namespace App\Domains\Item\DTOs;

class ItemAddedDTO
{
    const MESSAGE = "This item was added to cart.";
    private string $productId;
    private int $id;
    private int $quantity;
    private float $price;

    public function __construct(string $productId, int $quantity, int $id, float $price)
    {
        $this->productId = $productId;
        $this->quantity = $quantity;
        $this->id = $id;
        $this->price = $price;
    }

    public function toArray()
    {
        return [
            "product_id" => $this->productId,
            "quantity" => $this->quantity,
            "id" => $this->id,
            "price" => $this->price,
        ];
    }

    public function message(): string
    {
        return self::MESSAGE;
    }
}
