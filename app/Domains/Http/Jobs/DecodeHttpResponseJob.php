<?php

namespace App\Domains\Http\Jobs;

use App\Data\Models\Product;
use App\Exceptions\ExternalServiceCommException;
use JsonException;
use Lucid\Units\Job;

class DecodeHttpResponseJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private string $bodyResponse)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     * @throws JsonException
     */
    public function handle()
    {
        $responseArr = json_decode($this->bodyResponse, true, 512, JSON_THROW_ON_ERROR);

        if (!empty($responseArr["error"]) || empty($responseArr["content"]["offers"])) {
            throw new ExternalServiceCommException("The-external-service-did-not-return-data");
        }

        return $responseArr;
    }
}
