<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'vw_ProductCatalog';
    protected $primaryKey = "ID";
    public $timestamps = false;
    protected $guarded = [];
}
