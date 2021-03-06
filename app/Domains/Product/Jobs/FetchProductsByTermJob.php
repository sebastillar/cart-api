<?php

namespace App\Domains\Product\Jobs;

use App\Data\Repositories\ProductHttpRepository;
use App\Domains\Product\DTOs\FetchByTermDTO;
use App\Interfaces\RepositoryHttpInterface;
use JsonException;
use Lucid\Units\Job;

class FetchProductsByTermJob extends Job
{
    public function __construct(private FetchByTermDTO $fetchByTerm)
    {
    }

    /**
     * @throws JsonException
     */
    public function handle(RepositoryHttpInterface $repository)
    {
        $params = $this->fetchByTerm->toArray();
        return $repository->requestHttp($params["headers"], $params["body"]);
    }
}
