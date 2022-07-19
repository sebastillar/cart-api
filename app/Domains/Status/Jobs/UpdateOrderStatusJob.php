<?php

namespace App\Domains\Status\Jobs;

use App\Data\Models\Order;
use App\Domains\Status\Enums\OrderStatusesEnums;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Job;

class UpdateOrderStatusJob extends Job
{
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(private Order $order, protected string $status)
    {
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(EloquentRepositoryInterface $repository)
    {
        $status = $repository->findBy("description", $this->status);
        $this->order->status()->associate($status);
        $this->order->save();
    }
}
