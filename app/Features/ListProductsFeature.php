<?php

namespace App\Features;

use App\Domains\Product\DTOs\FetchByTermDTO;
use App\Domains\Product\Requests\ListProducts;
use App\Operations\FetchProductsFromExternalServiceOperation;
use Illuminate\Support\Facades\Response;
use Lucid\Units\Feature;

class ListProductsFeature extends Feature
{
    public function handle(ListProducts $request)
    {
        $params = $request->validated();
        $params["rapid_api_key"] = $request->header("X-RapidAPI-Key");
        $params["rapid_api_host"] = $request->header("X-RapidAPI-Host");

        $fetchByTerm = FetchByTermDTO::fromArray($params);

        $products = $this->run(new FetchProductsFromExternalServiceOperation($fetchByTerm));

        return Response::json(
            [
                "code" => 200,
                "message" => "List of products which has coincidence with the search term.",
                "data" => $products,
            ],
            200
        );
    }
}
