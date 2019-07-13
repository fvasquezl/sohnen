<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SkuData extends Model
{
    protected $table = 'SKUData';
    protected $primaryKey = "ID";
    public $timestamps = false;
    protected $guarded = [];

}
