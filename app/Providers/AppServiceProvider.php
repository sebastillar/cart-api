<?php

namespace App\Providers;

use App\Data\Repositories\CartRepository;
use App\Data\Repositories\ItemRepository;
use App\Data\Repositories\ProductHttpRepository;
use App\Data\Repositories\ProductRepository;
use App\Domains\Cart\Jobs\CalculateSubtotalJob;
use App\Domains\Cart\Jobs\FindCartByCustomerJob;
use App\Domains\Item\Jobs\CreateItemJob;
use App\Domains\Product\Jobs\CreateProductsFromArrayJob;
use App\Domains\Product\Jobs\FetchProductsByTermJob;
use App\Domains\Product\Jobs\FindProductByAsinJob;
use App\Listeners\CartRetrievedListener;
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
        $this->app->bindMethod(FindProductByAsinJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductRepository::class));
        });

        $this->app->bindMethod(FetchProductsByTermJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductHttpRepository::class));
        });

        $this->app->bindMethod(CreateProductsFromArrayJob::class . "@handle", function ($job, $app) {
            return $job->handle($app->make(ProductRepository::class));
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
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
