<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $table = 'Purchases';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];


    public function category()
    {
        return $this->belongsTo(Category::class,'BTSCategoryID');
    }
}
