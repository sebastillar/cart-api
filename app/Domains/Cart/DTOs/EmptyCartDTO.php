<?php

namespace App\Domains\Cart\DTOs;

class EmptyCartDTO
{
    public function __construct(private string $message, private bool $isEmpty)
    {
    }

    public function toArray()
    {
        return [
            "message" => $this->message,
            "is_empty" => $this->isEmpty,
        ];
    }
}
