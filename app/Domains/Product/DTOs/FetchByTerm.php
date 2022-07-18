<?php

namespace App\Domains\Product\DTOs;

class FetchByTerm
{
    public function __construct(private string $term, private string $apiKey, private string $apiHost)
    {
    }

    public static function fromArray(array $params): FetchByTerm
    {
        return new self($params["term"], $params["rapid_api_key"], $params["rapid_api_host"]);
    }

    public function toArray(): array
    {
        return [
            "headers" => [
                "rapid_api_key" => $this->apiKey,
                "rapid_api_host" => $this->apiHost,
            ],
            "body" => [
                "term" => $this->term,
            ],
        ];
    }
}
