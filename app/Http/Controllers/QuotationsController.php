<?php

namespace App\Http\Controllers;


use App\Http\Requests\Quotations\CreateQuotationsRequest;
use App\Quotation;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class QuotationsController extends Controller
{

    public function index(Request $request)
    {

        if ($request->ajax()) {

            if(auth()->user()->role === 'admin'){
                $data = auth()->user()->quotations();
            } elseif(auth()->user()->role === 'employee'){
                $data = auth()->user()->quotations()->select('SKU','Brand','Model','Description','PercentOfRetail','DateAdded','CustomerName');
            }


            return Datatables::of($data)->filter(function($query){

                if($customerName = session('CustomerName')){
                    $query->where('CustomerName',$customerName);
                }
            })->addIndexColumn()
                ->editColumn('UserID', auth()->user()->name )
                ->editColumn('PercentOfRetail', '{{$PercentOfRetail}} %')

                ->addColumn('Action', function($data){
                    $btns = '<a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })
                ->rawColumns(['Action'])
                ->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }
        if(auth()->user()->role==='admin')
            return view('quotations.index');
        elseif(auth()->user()->role==='employee'){
            return view('quotations.employee');
        }
    }

    public function store(CreateQuotationsRequest $request)
    {
        $request->createQuotation();

        return response()->json([
            'success' => true,
            'message' => 'The Product has been Included'
        ], 200);
    }


    public function destroy(Quotation $quotation)
    {
        $quotation->delete();

        return response()->json([
            'success' => true,
            'message' => 'The product has been deleted successfully'
        ], 200);
    }
}
