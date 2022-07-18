<?php

namespace App\Data\Repositories;

use App\Data\Models\Product;
use App\Exceptions\ExternalServiceCommException;
use App\Interfaces\RepositoryHttpInterface;
use Illuminate\Support\Facades\Http;
use JsonException;

class ProductHttpRepository implements RepositoryHttpInterface
{
    /**
     * @throws JsonException
     */
    public function requestHttp(array $headers, array $body): string
    {
        $response = Http::withHeaders([
            "X-RapidAPI-Key" => $headers["rapid_api_key"],
            "X-RapidAPI-Host" => $headers["rapid_api_host"],
        ])->get(env("PRODUCT_API_URL"), [
            "term" => $body["term"],
            "country" => "us",
        ]);

        if (!$response->successful()) {
            throw new ExternalServiceCommException();
        }

        return $response->body();
    }

    public function saveFromArray(array $models): array
    {
        return tap($models, function ($models) {
            Product::upsert($models, ["asin"], ["name", "link", "price"]);
        });
    }
}
