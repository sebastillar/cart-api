<?php

namespace App\Observers;

use App\Data\Models\Order;
use App\Domains\Status\Enums\OrderStatusesEnums;
use App\Interfaces\EloquentRepositoryInterface;
use App\Mail\OrderCompletedMail;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;

class OrderObserver
{
    public function __construct(protected EloquentRepositoryInterface $repository)
    {
    }

    /**
     * Handle the Order "created" event.
     *
     * @param Order $order
     * @return void
     */
    public function created(Order $order)
    {
        //
    }

    /**
     * Handle the Order "creating" event.
     *
     * @param Order $order
     * @return void
     */
    public function creating(Order $order)
    {
        $status = $this->repository->findBy("description", OrderStatusesEnums::STATUS_CREATED);
        $order->status()->associate($status);
    }

    /**
     * Handle the Order "updated" event.
     *
     * @param Order $order
     * @return void
     */
    public function updating(Order $order)
    {
        $order->total_amount = $order->totalAmount();
        /*
        if ($order->status->toArray()["description"] === OrderStatusesEnums::STATUS_COMPLETED) {
            Mail::to(env("MAIL_TO"))->send(new OrderCompletedMail());

        }
        */
    }

    /**
     * Handle the Order "deleted" event.
     *
     * @param Order $order
     * @return void
     */
    public function deleted(Order $order)
    {
        //
    }

    /**
     * Handle the Order "restored" event.
     *
     * @param Order $order
     * @return void
     */
    public function restored(Order $order)
    {
        //
    }

    /**
     * Handle the Order "force deleted" event.
     *
     * @param Order $order
     * @return void
     */
    public function forceDeleted(Order $order)
    {
        //
    }
}
