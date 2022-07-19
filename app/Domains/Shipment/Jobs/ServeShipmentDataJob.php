<?php

namespace App\Domains\Shipment\Jobs;

use App\Data\Models\Order;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class ServeShipmentDataJob extends Job
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
        $shipmentDataResponse = [
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
            "shipment_amount" => 23,
        ];

        $this->order->shipment_amount = $shipmentDataResponse["shipment_amount"];
        unset($shipmentDataResponse["shipment_amount"]);
        $this->order->shipment_data = $shipmentDataResponse;
        return $repository->update($this->order, $shipmentDataResponse);
    }
}
