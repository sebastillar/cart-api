<?php

namespace App\Http\Controllers;

use Lucid\Units\Controller;

class CartController extends Controller
{
    public function store($customer_id)
    {
        return $this->serve(new AddItemFeature());
    }

    public function show($customer_id)
    {
        return $this->serve(new ListItemsFeature());
    }

    public function destroy($customer_id, $item_id)
    {
        return $this->serve(new RemoveItemFeature());
    }
}
