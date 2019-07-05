<?php

namespace App\Http\Requests\Products;

use App\Inventory;
use App\Product;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'QtyNew'=>'required',
            'QtyGradeB'=>'required',
            'QtyGradeC'=>'required',
            'QtyGradeX'=>'required',
        ];
    }

    public function updateProduct(Product $product)
    {
        $inventory = Inventory::where('SKU',$product->SKU)->firstOrFail();

        $inventory->QtyNew = $this->QtyNew;
        $inventory->QtyGradeB = $this->QtyGradeB;
        $inventory->QtyGradeC = $this->QtyGradeC;
        $inventory->QtyGradeX = $this->QtyGradeX;
        $inventory->save();
    }
}
