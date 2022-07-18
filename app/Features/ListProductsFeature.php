<?php

namespace App\Features;

use App\Domains\Http\Jobs\DecodeHttpResponseJob;
use App\Domains\Product\DTOs\FetchByTerm;
use App\Domains\Product\Jobs\CreateProductsFromArrayJob;
use App\Domains\Product\Jobs\FetchProductsByTermJob;
use App\Domains\Product\Requests\ListProducts;
use Illuminate\Support\Facades\Response;
use Lucid\Units\Feature;

class ListProductsFeature extends Feature
{
    public function handle(ListProducts $request)
    {
        $params = $request->validated();
        $params["rapid_api_key"] = $request->header("X-RapidAPI-Key");
        $params["rapid_api_host"] = $request->header("X-RapidAPI-Host");

        $fetchByTerm = FetchByTerm::fromArray($params);

        $httpResponse = $this->run(new FetchProductsByTermJob($fetchByTerm));

        $products = $this->run(new DecodeHttpResponseJob($httpResponse));

        $saved = $this->run(new CreateProductsFromArrayJob($products, 10));

        return Response::json(
            [
                "code" => 200,
                "message" => "List of products which has coincidence with the search term.",
                "data" => $saved,
            ],
            200
        );
    }
}
