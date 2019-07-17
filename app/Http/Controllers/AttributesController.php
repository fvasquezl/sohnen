<?php

namespace App\Http\Controllers;

use App\Attribute;
use Illuminate\Http\Request;

class AttributesController extends Controller
{
    public function index($sku){
        return Attribute::where('SKU', $sku)->get();
    }

    public function show(Attribute $attribute)
    {
        $category = $attribute->category()->get()->toArray()[0];

        $data = ['Category' => $category['CategoryName']];
        $keys = $this->filterElements($category, 2, 10);

        $attributes = $attribute->toArray();
        $values = $this->filterElements($attributes, 2, 10);

        if (count($values) != 0){
            $data = array_merge($data,array_combine($keys,$values));
        }

       return json_encode($data);
    }


    /**
     * Remove any elements where the value is empty
     * @param  array $array the array to walk
     * @return array
     */
    function removeEmptyValues(array &$array){
        foreach ($array as $key => &$value) {
            if (is_array($value)) {
                $value = removeEmptyValues($value);
            }
            if (empty($value)) {
                unset($array[$key]);
            }
        }
        return $array;
    }


    function filterElements(array &$array,$start,$end)
    {
        $array_new =array_slice($array, $start,$end);
        return $this->removeEmptyValues($array_new);
    }

}
