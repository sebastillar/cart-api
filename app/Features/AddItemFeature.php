<?php

namespace App\Features;

use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Requests\AddItem;
use App\Domains\Item\DTOs\ItemDTO;
use App\Domains\Item\Jobs\CreateItemJob;
use App\Domains\Product\DTOs\FetchByTermDTO;
use App\Domains\Product\Jobs\FindProductByAsinJob;
use App\Operations\FetchProductsFromExternalServiceOperation;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lucid\Units\Feature;
use Illuminate\Support\Facades\Response;

class AddItemFeature extends Feature
{
    public function handle(AddItem $request)
    {
        $params = $request->validated();

        $cart = $this->run(new FindCartByCustomerJob($params["customer_id"]));
        try {
            $product = $this->run(new FindProductByAsinJob($params["item"]["product"]["asin"]));
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                $params["rapid_api_key"] = $request->header("X-RapidAPI-Key");
                $params["rapid_api_host"] = $request->header("X-RapidAPI-Host");
                $params["term"] = $params["item"]["product"]["name"];
                $fetchByTerm = FetchByTermDTO::fromArray($params);

                $this->run(new FetchProductsFromExternalServiceOperation($fetchByTerm));

                $product = $this->run(new FindProductByAsinJob($params["item"]["product"]["asin"]));
            }
        }

        $itemDTO = new ItemDTO($params["item"]["quantity"], $product, $cart);
        $item = $this->run(new CreateItemJob(item: $itemDTO));

        return Response::json(
            [
                "code" => 200,
                "message" => $item->message(),
                "data" => $item->toArray(),
            ],
            200
        );
    }
}
