<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SID extends Model
{
    protected $table = 'BM.SKUInventoryDetail';
    protected $primaryKey = 'SKU';
}
