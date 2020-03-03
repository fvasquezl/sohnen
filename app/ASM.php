<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ASM extends Model
{
    protected $table = 'SKUMapping-Amazon';
    protected $primaryKey = 'SKU';
    public $timestamps = false;
    protected $guarded = [];
 
}
