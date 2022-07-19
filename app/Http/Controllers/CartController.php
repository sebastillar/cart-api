<?php

namespace App\Http\Controllers;

use App\Features\AddItemFeature;
use App\Features\ListItemsFeature;
use App\Features\RemoveItemFeature;
use App\Interfaces\EloquentRepositoryInterface;
use Lucid\Units\Controller;

class CartController extends Controller
{
    public function store($customer_id)
    {
        return $this->serve(AddItemFeature::class);
    }

    public function show($customer_id)
    {
        return $this->serve(ListItemsFeature::class);
    }

    public function destroy($customer_id, $item_id)
    {
        return $this->serve(RemoveItemFeature::class);
    }
}
