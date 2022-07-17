<?php

namespace App\Http\Controllers;

use Lucid\Units\Controller;

class CheckoutController extends Controller
{
    public function store($customer_id)
    {
        return $this->serve(new CheckoutFeature());
    }
}
