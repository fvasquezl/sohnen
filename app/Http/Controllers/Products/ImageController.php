<?php

namespace App\Http\Controllers\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Photo;

class ImageController extends Controller
{
    public function index(Request $request)
    {
        $sku =collect($request->segments())->last();

        return Photo::where('SKU',$sku)->pluck('URL','ID');

       /// return  DB::select("EXEC [Sohnen].[BM].[sp_GetBinsBySKU] '{$sku}'");
    }
}
