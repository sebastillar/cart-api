<?php

namespace App\Operations;

use App\Domains\Http\Jobs\DecodeHttpResponseJob;
use App\Domains\Product\DTOs\FetchByTermDTO;
use App\Domains\Product\Jobs\CreateProductsFromArrayJob;
use App\Domains\Product\Jobs\FetchProductsByTermJob;
use Lucid\Units\Operation;

class FetchProductsFromExternalServiceOperation extends Operation
{
    protected FetchByTermDTO $fetchByTermDTO;

    /**
     * Create a new operation instance.
     *
     * @return void
     */
    public function __construct(FetchByTermDTO $fetchByTermDTO)
    {
        $this->fetchByTermDTO = $fetchByTermDTO;
    }

    /**
     * Execute the operation.
     *
     * @return void
     */
    public function handle()
    {
        $httpResponse = $this->run(new FetchProductsByTermJob($this->fetchByTermDTO));

        $products = $this->run(new DecodeHttpResponseJob($httpResponse));

        return $this->run(new CreateProductsFromArrayJob($products, 10));
    }
}
