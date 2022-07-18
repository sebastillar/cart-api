<?php

namespace App\Features;

use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\CheckIsEmptyJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RespondWithJsonJob;
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
                $product = $this->retrieveProductFromExternalAPi($params, $request);
            }
        }

        $itemDTO = new ItemDTO($params["item"]["quantity"], $product, $cart);
        $item = $this->run(new CreateItemJob(item: $itemDTO));

        $this->run(new CalculateSubtotalJob($cart));

        $results = [
            "message" => $item->message(),
            "data" => $item->toArray(),
        ];
        
        $isEmpty = $this->run(new CheckIsEmptyJob($cart));

        return $this->run(new RespondWithJsonJob($cart, $results, $isEmpty));
    }

    private function retrieveProductFromExternalAPi(array $params, AddItem $request)
    {
        $params["rapid_api_key"] = $request->header("X-RapidAPI-Key");
        $params["rapid_api_host"] = $request->header("X-RapidAPI-Host");
        $params["term"] = $params["item"]["product"]["name"];

        $fetchByTerm = FetchByTermDTO::fromArray($params);

        $this->run(new FetchProductsFromExternalServiceOperation($fetchByTerm));

        return $this->run(new FindProductByAsinJob($params["item"]["product"]["asin"]));
    }
}
