<?php

namespace App\Http\Controllers;

use App\Features\ListProductsFeature;
use Lucid\Units\Controller;

class ProductController extends Controller
{
    public function index()
    {
        return $this->serve(ListProductsFeature::class);
    }
}
