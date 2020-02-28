<?php

namespace App\Http\Requests\Skus;

use App\Sku;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class SaveSkuRequest extends FormRequest
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
        $rules = [
            'SKU'=> ['required',Rule::unique('sqlsrv.dbo.SKUDetails', 'SKU')
            ->where(function($query) {
                $query->where('LanguageID', $this->LanguageID);
            })->ignore($this->ID)],

            'LanguageID' => ['required',Rule::unique('sqlsrv.dbo.SKUDetails', 'LanguageID')
          ->where(function($query) {
              $query->where('SKU', $this->SKU);
          })->ignore($this->ID)]
         ];
 
        if ($this->method() === 'PUT') {
            
          $rules['SKU'] = ['sometimes'];
          $rules['LanguageID'] = ['sometimes'];
          $rules['Title80'] = ['required', 'string', 'max:80'];
          $rules['Title200'] = ['required', 'string', 'max:200'];
          $rules['Bullet1'] = ['required', 'string', 'max:200'];
          $rules['Bullet2'] = ['required', 'string', 'max:200'];
          $rules['Bullet3'] = ['required', 'string', 'max:200'];
          $rules['Bullet4'] = ['required', 'string', 'max:200'];
          $rules['Bullet5'] = ['required', 'string', 'max:200'];
          $rules['ShortDescription'] = ['required', 'string', 'max:500'];
          $rules['Description'] = ['required', 'string', 'max:2000'];
          $rules['SearchTerms'] = ['required', 'string', 'max:200'];
         }
 
         return $rules;
    }

    public function createSku()
    {
        $sku = Sku::create([
            'SKU'=>$this->SKU,
            'LanguageID'=>$this->LanguageID
        ]);

        return $sku;
    }

    public function updateSku($sku)
    {

        $sku->update($this->all());

        return $sku;
    }

}
