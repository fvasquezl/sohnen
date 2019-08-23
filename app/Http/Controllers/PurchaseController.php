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

        $data = Purchase::leftjoin('Categories', 'Purchases.BTSCategoryID', '=', 'Categories.CategoryID')
            ->select('Purchases.ID',
                'Purchases.BTSSKU',
                'Purchases.Brand',
                'Purchases.ScreenSize',
                'Purchases.MFGSKU',
                'Purchases.ItemDescription',
                'Purchases.Qty',
                'Purchases.EstimatedRetail',
                'Purchases.Price',
                'Purchases.BTSLoadID',
                'Purchases.SohnenLoadID',
                'Purchases.LoadDate',
                'Purchases.AddedDate',
                'Categories.CategoryName');

        if ($request->ajax()) {

            return Datatables::of($data)->filter(function($query) use($request){
                if($loadDate = $request->loadDate){
                    $query->where('LoadDate',$loadDate);
                }
                if($btsLoadId = $request->btsLoadId){
                    $query->where('BTSLoadID',$btsLoadId);
                }
            },true)
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
