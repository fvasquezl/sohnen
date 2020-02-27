<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sku extends Model
{
    protected $table = 'SKUDetails';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];


    public function language()
    {
        return $this->belongsTo(Lang::class,'LanguageID');
    }
}
