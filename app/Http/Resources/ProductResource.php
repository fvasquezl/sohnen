<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'SKU'=>$this->SKU,
            'Brand'=>$this->Brand,
            'Model'=>$this->Model,
            'Description'=>$this->Description,
            'EstimatedRetail'=>$this->EstimatedRetail,
            'AvgCost'=>$this->AvgCost,
            'QtyNew'=>$this->QtyNew,
            'SalePriceNew'=>$this->SalePriceNew,
            'QtyGradeB'=>$this->QtyGradeB,
            'SalePriceGradeB'=>$this->SalePriceGradeB,
            'QtyGradeC'=>$this->QtyGradeC,
            'SalePriceGradeC'=>$this->SalePriceGradeC,
            'QtyGradeX'=>$this->QtyGradeX,
            'SalePriceGradeX'=>$this->SalePriceGradeX,
            'AddedDate'=>$this->AddedDate,
            'TotalQtyPurchased'=>$this->TotalQtyPurchased,
            'FirstPurchaseDate'=>$this->FirstPurchaseDate,
            'Attribute01' => $this->Attribute01,
            'Attribute02' => $this->Attribute02,
            'Attribute03' => $this->Attribute03,
            'Attribute04' => $this->Attribute04,
            'Attribute05' => $this->Attribute05,
            'Attribute06' => $this->Attribute06,
            'Attribute07' => $this->Attribute07,
            'Attribute08' => $this->Attribute08,
            'Attribute09' => $this->Attribute09,
            'Attribute10' => $this->Attribute10,
        ];
    }
}
