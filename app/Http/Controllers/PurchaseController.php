<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{

    public function index(Request $request)
    {
        $btsLoadId = Purchase::groupBy('BTSLoadID')->pluck('BTSLoadID');

        if ($request->ajax()) {

            $data = Purchase::with('category')
                ->select('ID','BTSSKU','Brand','ScreenSize','MFGSKU','ItemDescription','Qty','EstimatedRetail','Price','BTSLoadID','SohnenLoadID','LoadDate','AddedDate');

            return Datatables::of($data)->filter(function($query) use($request){
                if($loadDate = $request->loadDate){
                    $query->where('LoadDate',$loadDate);
                }
                if($btsLoadId = $request->btsLoadId){
                    $query->where('BTSLoadID',$btsLoadId);
                }
            })->addIndexColumn()->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }

        return view('purchase.index', [
            'btsLoadIds' => $btsLoadId
        ]);
    }
}
