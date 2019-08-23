<?php

namespace App\Http\Controllers;

use App\Purchase;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class PurchaseController extends Controller
{

    public function index(Request $request)
    {
        $btsLoadIds = Purchase::groupBy('BTSLoadID')->pluck('BTSLoadID');
        $loadDates = Purchase::groupBy('LoadDate')->pluck('LoadDate');

        if ($request->ajax()) {
            $data = Purchase::with('category');

            return Datatables::of($data)->filter(function($query) use($request){
                if($loadDate = $request->loadDate){
                    $query->where('LoadDate',$loadDate);
                }
                if($btsLoadId = $request->btsLoadId){
                    $query->where('BTSLoadID',$btsLoadId);
                }
            },true)
                ->editColumn('CategoryName', function($query)
                {
                    return $query->category->CategoryName;
                })
                ->addIndexColumn()->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }

        return view('purchase.index', [
            'btsLoadIds' => $btsLoadIds,
            'loadDates' => $loadDates
        ]);
    }

}
