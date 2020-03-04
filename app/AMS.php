<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AMS extends Model
{
    protected $table = 'AmazonMerchantSKU';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];
}
