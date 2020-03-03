<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Photo extends Model
{
    protected $guarded = [];
    protected $table ='SKUPhotos';
    const CREATED_AT = 'DateCreated';
    const UPDATED_AT = 'DateUpdated';
    protected $primaryKey = 'ID';

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($image) {
            Storage::disk('public')->delete($image->url);
        });

    }
}
