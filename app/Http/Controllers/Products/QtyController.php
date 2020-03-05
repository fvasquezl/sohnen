<?php

namespace App\Http\Controllers\Products;

use App\SID;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class QtyController extends Controller
{

    public function index(Request $request)
    {
        $sku =collect($request->segments())->last();
        return  DB::select("EXEC [Sohnen].[BM].[sp_GetBinsBySKU] '{$sku}'");
    }
}
