<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    //
    protected $fillable = [
        'itemname',
        'retailrate',
        'hotelrate',
        'masterid',
        'image',
        'stock',
        'type'
    ];
}
