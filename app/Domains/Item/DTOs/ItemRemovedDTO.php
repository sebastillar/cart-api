<?php

namespace App\Domains\Item\DTOs;

class ItemRemovedDTO
{
    public function __construct(private string $message, private bool $removed)
    {
    }

    public function toArray()
    {
        return [
            "removed" => $this->removed,
            "message" => $this->message,
        ];
    }
}
