<?php

namespace App\Http\Controllers\Skus;

use App\Http\Controllers\Controller;
use App\Http\Requests\Skus\SaveSkuRequest;
use App\Lang;
use App\Sku;
use Carbon\Language;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SkuDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $languages = Lang::get();

        if ($request->ajax()) {

            $data = Sku::with('language');

            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('Action', function () {
                    $btns = '<a href="#" class="btn btn-primary btn-sm update-btn"><i class="fas fa-pencil-alt"></i></a>
                             <a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })
                ->editColumn('LanguageID', function ($query) {
                    return $query->language->Language;
                })
                ->rawColumns(['Action'])
                ->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }

        return view('skus.index',compact('languages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Lang::get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SaveSkuRequest $request)
    {
        $sku = $request->createSku();
        return redirect()->route('sku.edit', $sku);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Sku $sku)
    {
        $languages = Lang::get();
        return view('skus.edit', [
            'sku' => $sku,
            'languages' => Lang::get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SaveSkuRequest $request, Sku $sku)
    {
        $user = $request->updateSku($sku);
        return back()->with('success', 'The product has been update successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
