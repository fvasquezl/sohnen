<?php

namespace App\Http\Controllers;

use App\Exports\ProductsExport;
use Illuminate\Http\Request;

class ExportController extends Controller
{
    public function products(Request $request)
    {
        return (new ProductsExport)
            ->search($request->search)
            ->brand($request->brand)
            ->download('products.xlsx');
    }
}
