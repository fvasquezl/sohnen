<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ASM extends Model
{
    protected $table = 'SKUMapping-Amazon';
    protected $primaryKey = 'ID';
    public $timestamps = false;
    protected $guarded = [];
    protected $casts = [
        'IsRenewed'=> 'bool',
    ];



    public function SetIsRenewedAttribute($value)
    {
        if(!isset($value) || $value=='false'){
            
            $this->attributes['IsRenewed'] = false;
        }else{
            $this->attributes['IsRenewed'] = $value;
        }
    }
 
}
