<?php

namespace App\Domains\Item\DTOs;

class ItemNotAdded
{
    const MESSAGE = "This product was already in the cart.";

    public function __construct()
    {
    }

    public function toArray()
    {
        return [];
    }

    public function message(): string
    {
        return self::MESSAGE;
    }
}
