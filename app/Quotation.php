<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    protected $table = 'Quotations';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];
    protected $dates = ['DateAdded'];

    public function Product()
    {
        return $this->belongsTo(Product::class,'ID');
    }


    public function User()
    {
        return $this->belongsTo(User::class);
    }

}
