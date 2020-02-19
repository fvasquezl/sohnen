<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'vw_ProductCatalog';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];

    public function category()
    {
        return $this->belongsTo(Category::class,'CategoryID');
    }

    public function quotations()
    {
        return $this->hasMany(Quotation::class,'UserID');
    }
}