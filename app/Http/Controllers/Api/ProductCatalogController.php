<?php

namespace App\Http\Controllers\Api;

use App\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductCatalogController extends Controller
{
    public function index()
    {
        return Product::get();
    }
}
