<?php

namespace App\Domains\Cart\Jobs;

use App\Data\Models\Cart;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Lucid\Units\Job;

class RespondWithJsonJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Cart $cart, private array $results, private bool $isEmpty)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return JsonResponse
     */
    public function handle()
    {
        if ($this->isEmpty) {
            $this->results = [
                "message" => "Cart is empty.",
                "data" => [
                    "subtotal_amount" => $this->cart->subtotal_amount,
                ],
            ];
        }

        return Response::json(
            [
                "code" => 200,
                "message" => $this->results["message"],
                "data" => $this->results["data"],
            ],
            200
        );
    }
}
