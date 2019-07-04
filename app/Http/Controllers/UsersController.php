<?php

namespace App\Http\Controllers;

use App\Product;
use App\User;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {

            $data = User::query();

            return Datatables::of($data)->filter(function($query) use($request) {
                if($brand = $request->brand){
                    $query->where('Brand',$brand);
                }
            },true)
                ->addIndexColumn()
                ->editColumn('name', '<a href="#" class="update-btn">{{$name}}</a>')
                ->addColumn('Action', function($row){
                    $btns = '<a href="#" class="btn btn-primary btn-sm update-btn"><i class="fas fa-pencil-alt"></i></a>
                             <a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })
                ->rawColumns(['name','Action'])
                ->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }
        return view('users.index',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
