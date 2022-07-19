<?php

namespace App\Domains\Payment\Jobs;

use App\Data\Models\Order;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class ServePaymentDataJob extends Job
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
        $paymentDataResponse = [
            "name_on_card" => "Ben Bitdiddle",
            "security_code" => "123",
            "number" => "5555555555554444",
            "expiration_month" => 11,
            "expiration_year" => 2022,
            "payment_status" => 1,
            "payment_method" => 1,
        ];

        $this->order->payment_status = $paymentDataResponse["payment_status"];
        unset($paymentDataResponse["shipment_amount"]);
        $this->order->shipment_data = $paymentDataResponse;
        return $repository->update($this->order, $paymentDataResponse);
    }
}
