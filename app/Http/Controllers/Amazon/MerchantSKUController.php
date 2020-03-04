<?php

namespace App\Http\Controllers\Amazon;

use App\AMS;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class MerchantSKUController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = AMS::all();

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Action', function () {
                    $btns = '<a href="#" class="btn btn-primary btn-sm update-btn"><i class="fas fa-pencil-alt"></i></a>
                             <a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })
                ->rawColumns(['Action'])
                ->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }

        return view('merchant.index');
    }
}
