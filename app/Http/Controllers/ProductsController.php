<?php

namespace App\Http\Controllers;

use App\Http\Requests\Products\UpdateProductRequest;
use App\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return Renderable
     * @throws \Exception
     */
    public function index(Request $request)
    {

        $brands =Product::groupBy('Brand')->pluck('Brand');

        if ($request->ajax()) {

            $data = Product::query();

            return Datatables::of($data)->filter(function($query) use($request) {
                            if($brand = $request->brand){
                                $query->where('Brand',$brand);
                            }
                        },true)
                ->addIndexColumn()
                ->editColumn('SKU', '<a href="#" class="update-btn">{{$SKU}}</a>')
                ->addColumn('TotalStock',function($data){
                    return $data->QtyNew +$data->QtyGradeB+$data->QtyGradeC+$data->QtyGradeX;
                })
                ->addColumn('Action', function($data){
                    $btns = '<a href="#" class="btn btn-primary btn-sm update-btn"><i class="fas fa-pencil-alt"></i></a>
                             <a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })
                ->rawColumns(['SKU','Action'])
                ->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }
        return view('products.index',compact('brands'));
    }

    public function store()
    {
        return response()->json([
            'success' => true,
            'message' => 'The product has been created successfully'
        ], 200);
    }

    public function show(Product $product)
    {
      return $product;
    }

    public function update(UpdateProductRequest $request,Product $product)
    {
        $request->updateProduct($product);

        return response()->json([
            'success' => true,
            'message' => 'The product has been updated successfully'
        ], 200);
    }

    public function destroy(Product $product)
    {
        return response()->json([
            'success' => true,
            'message' => 'The product has been deleted successfully'
        ], 200);
    }


}
