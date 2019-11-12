<?php

namespace App\Http\Controllers\Products;

use App\Category;
use App\Http\Controllers\Controller;
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
//    public function __construct()
//    {
//        $this->middleware('auth');
//    }

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
        $categories = Category::select('CategoryID','CategoryName')->get()->toArray();


        if ($request->ajax()) {

            if(auth()->user()->role == 'admin'){
                $data = Product::with('category');
            }else{
                $data = Product::with('category')
                    ->select('ID','SKU','Brand','Model','Description','EstimatedRetail','AvgCost',
                        'QtyPending','AddedDate','TotalQtyPurchased','FirstPurchaseDate');
            }


            return Datatables::of($data)->filter(function($query) use($request) {
                            if($brand = $request->brand){
                                $query->where('Brand',$brand);
                            }
                            if($category = $request->category){
                                $query->where('CategoryID',$category);
                            }
                            if($hasInventory = $request->hasInventory == 'true'){
                                $query->where(function($q){
                                    $q->where('QtyNew','>',0)
                                        ->orWhere('QtyGradeB','>',0)
                                        ->orWhere('QtyGradeC','>',0)
                                        ->orWhere('QtyGradeX','>',0);
                                });
                            }
                        },true)
                ->addIndexColumn()
                ->addColumn('toCustomer',function($data){
                    return '<a href="#" class="btn btn-info btn-sm btn-block quote-btn"><i class="fas fa-check-double"></i></a>';
                })
                ->addColumn('TotalStock',function($data){
                    return $data->QtyNew +$data->QtyGradeB+$data->QtyGradeC+$data->QtyGradeX;
                })
                ->addColumn('Action', function($data){
                    $btns = '<a href="#" class="btn btn-primary btn-sm update-btn"><i class="fas fa-pencil-alt"></i></a>
                             <a href="#" class="btn btn-danger btn-sm delete-btn"><i class="fas fa-trash-alt"></i></a>';
                    return $btns;
                })
                ->rawColumns(['Action','toCustomer','TotalStock','SKU'])
                ->setRowId(function ($data) {
                    return $data->ID;
                })
                ->make(true);
        }

        if(auth()->user()->role == 'admin'){
            return view('products.index',[
                'brands'=>$brands,
                'categories'=>$categories,
                'customerName' => session('CustomerName'),
                'percentOfRetail' => session('PercentOfRetail'),
            ]);
        }else{
            return view('products.employee',[
                'brands'=>$brands,
                'categories'=>$categories,
                'customerName' => session('CustomerName'),
                'percentOfRetail' => session('PercentOfRetail'),
            ]);
        }

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
