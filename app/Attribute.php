<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    protected $table = 'Attributes';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];
}
