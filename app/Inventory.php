<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'Inventory';
    protected $primaryKey = "ID";
    public $timestamps = false;
    protected $guarded = [];
}
