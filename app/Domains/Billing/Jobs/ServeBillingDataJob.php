<?php

namespace App\Domains\Billing\Jobs;

use App\Data\Models\Order;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class ServeBillingDataJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Order $order)
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $billingDataResponse = [
            "address_line1" => "77 Massachusetts Avenue",
            "address_line2" => null,
            "first_name" => "John",
            "city" => "Cambridge",
            "country" => "US",
            "date" => "12-30-2022",
            "last_name" => "Doe",
            "state" => "MA",
            "zip_code" => "81543",
            "id" => 1,
            "tax_amount" => 88,
        ];

        $this->order->tax_amount = $billingDataResponse["tax_amount"];
        unset($billingDataResponse["tax_amount"]);
        $this->order->billing_data = $billingDataResponse;
        $repository = $repository->update($this->order, $billingDataResponse);
    }
}
