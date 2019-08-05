<?php

namespace App\Http\Requests\Quotations;

use App\Quotation;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateQuotationsRequest extends FormRequest
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
            'SKU' => ['required',Rule::unique('sqlsrv.dbo.Quotations')],
            'Qty' => 'required',
            'Condition' => ['required',Rule::in(['New','B','C','X'])],
            'PercentOfRetail' => 'required',
            'SalePrice' => 'required',
            'CustomerName' => 'required',
        ];
    }

    public function createQuotation()
    {
        $quotation = new Quotation();

        $quotation->fill([
            'SKU'=>$this->SKU,
            'Qty'=>$this->Qty,
            'Condition'=>$this->Condition,
            'PercentOfRetail'=>$this->PercentOfRetail,
            'SalePrice'=>$this->SalePrice,
            'UserID' => auth()->id(),
            'DateAdded' => now(),
            'CustomerName'=>$this->CustomerName,
        ]);

        $quotation->save();
    }
}
