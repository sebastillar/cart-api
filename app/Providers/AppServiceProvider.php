<?php

namespace App\Providers;

use App\Data\Models\Order;
use App\Data\Repositories\CartRepository;
use App\Data\Repositories\ItemRepository;
use App\Data\Repositories\OrderRepository;
use App\Data\Repositories\ProductHttpRepository;
use App\Data\Repositories\ProductRepository;
use App\Data\Repositories\StatusRepository;
use App\Domains\Billing\Jobs\ServeBillingDataJob;
use App\Domains\Cart\Jobs\AddNewItemJob;
use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Cart\Jobs\RemoveItemFromCartJob;
use App\Domains\Item\Jobs\CreateItemJob;
use App\Domains\Item\Jobs\IncreaseQuantityJob;
use App\Domains\Order\Jobs\AddItemsToOrderJob;
use App\Domains\Order\Jobs\CreateOrderJob;
use App\Domains\Payment\Jobs\ServePaymentDataJob;
use App\Domains\Product\Jobs\AssociateProductItemJob;
use App\Domains\Product\Jobs\CreateProductsFromArrayJob;
use App\Domains\Product\Jobs\FetchProductsByTermJob;
use App\Domains\Product\Jobs\FindProductByAsinJob;
use App\Domains\Shipment\Jobs\ServeShipmentDataJob;
use App\Domains\Status\Jobs\UpdateOrderStatusJob;
use App\Interfaces\EloquentRepositoryInterface;
use App\Observers\OrderObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bindMethod(CreateProductsFromArrayJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductRepository::class));
        });

        $this->app->bindMethod(FindProductByAsinJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductRepository::class));
        });

        $this->app->bindMethod(FetchProductsByTermJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductHttpRepository::class));
        });

        $this->app->bindMethod(FindCartByCustomerJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(CartRepository::class));
        });

        $this->app->bindMethod(CreateItemJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ItemRepository::class));
        });

        $this->app->bindMethod(CalculateSubtotalJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(CartRepository::class));
        });

        $this->app->bindMethod(RemoveItemFromCartJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ItemRepository::class));
        });

        $this->app->bindMethod(CreateOrderJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(OrderRepository::class));
        });

        $this->app->bindMethod(AddItemsToOrderJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(OrderRepository::class));
        });

        $this->app->bindMethod(AssociateProductItemJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductRepository::class));
        });

        $this->app->bindMethod(AddNewItemJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(CartRepository::class));
        });

        $this->app->bindMethod(IncreaseQuantityJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ItemRepository::class));
        });

        $this->app->bindMethod(UpdateOrderStatusJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(StatusRepository::class));
        });

        $this->app->bindMethod(ServeBillingDataJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(OrderRepository::class));
        });

        $this->app->bindMethod(ServeShipmentDataJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(OrderRepository::class));
        });

        $this->app->bindMethod(ServePaymentDataJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(OrderRepository::class));
        });

        $this->app
            ->when(OrderObserver::class)
            ->needs(EloquentRepositoryInterface::class)
            ->give(StatusRepository::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Order::observe(OrderObserver::class);
    }
}
