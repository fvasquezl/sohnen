<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'Categories';
    protected $primaryKey = 'CategoryID';
    public $timestamps = false;
    protected $guarded = [];


    public function product()
    {
        return $this->hasOne(Product::class);
    }

    public function attributes()
    {
        return $this->hasMany(Attribute::class);
    }
}
