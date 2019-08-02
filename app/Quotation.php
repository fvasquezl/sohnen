<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'Quotations';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];

}
