<?php

namespace App\Operations;

use App\Data\Models\Product;
use App\Domains\Cart\Requests\AddItem;
use App\Domains\Product\DTOs\FetchByTermDTO;
use App\Domains\Product\Jobs\FindProductByAsinJob;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Lucid\Units\Operation;

class FindOrCreateProductOperation extends Operation
{
    /**
     * Create a new operation instance.
     *
     * @return void
     */
    public function __construct(private array $params, private AddItem $request)
    {
        //
    }

    /**
     * Execute the operation.
     *
     * @return Product|null
     */
    public function handle(): ?Product
    {
        $product = null;
        $asin = $this->params["item"]["product"]["asin"];
        $term = $this->params["item"]["product"]["name"];

        try {
            $product = $this->run(new FindProductByAsinJob($asin));
        } catch (Exception $exception) {
            if ($exception instanceof ModelNotFoundException) {
                $params["rapid_api_key"] = $this->request->header("X-RapidAPI-Key");
                $params["rapid_api_host"] = $this->request->header("X-RapidAPI-Host");
                $params["term"] = $term;

                $fetchByTerm = FetchByTermDTO::fromArray($params);

                $this->run(new FetchProductsFromExternalServiceOperation($fetchByTerm));

                $product = $this->run(new FindProductByAsinJob($asin));
            }
        }

        return $product;
    }
}
