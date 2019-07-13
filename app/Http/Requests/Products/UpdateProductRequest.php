<?php

namespace App\Http\Requests\Products;

use App\Attribute;
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
            'CategoryID'=>'required',
            'Attribute01'=>'',
            'Attribute02'=>'',
            'Attribute03'=>'',
            'Attribute04'=>'',
            'Attribute05'=>'',
            'Attribute06'=>'',
            'Attribute07'=>'',
            'Attribute08'=>'',
            'Attribute09'=>'',
            'Attribute10'=>'',
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

        $attribute = Attribute::where('SKU',$product->SKU)->firstOrFail();
        $attribute->CategoryID = $this->CategoryID;
        $attribute->Attribute01 = $this->Attribute01;
        $attribute->Attribute02 = $this->Attribute02;
        $attribute->Attribute03 = $this->Attribute03;
        $attribute->Attribute04 = $this->Attribute04;
        $attribute->Attribute05 = $this->Attribute05;
        $attribute->Attribute06 = $this->Attribute06;
        $attribute->Attribute07 = $this->Attribute07;
        $attribute->Attribute08 = $this->Attribute08;
        $attribute->Attribute09 = $this->Attribute09;
        $attribute->Attribute10 = $this->Attribute10;
        $attribute->save();

    }
}
