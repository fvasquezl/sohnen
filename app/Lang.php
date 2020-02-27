<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lang extends Model
{
    protected $table = 'Languages';
    protected $primaryKey = 'LanguageID';
    public $timestamps = false;
    protected $guarded = [];


    public function skus()
    {
        return $this->hasMany(Sku::class,'ID');
    }
}
