<?php

namespace App\Providers;

use App\Data\Repositories\ProductHttpRepository;
use App\Interfaces\RepositoryHttpInterface;
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
        $this->app->bind(RepositoryHttpInterface::class, ProductHttpRepository::class);
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
