<?php

namespace App\Features;

use App\Domains\Product\Requests\ListProducts;
use Lucid\Units\Feature;

class ListProductsFeature extends Feature
{
    public function handle(ListProducts $request)
    {
        dd($request->validated());
    }
}
