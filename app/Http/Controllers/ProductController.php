<?php

namespace App\Http\Controllers;

use Lucid\Units\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return $this->serve(new ListProductsFeature());
    }
}
