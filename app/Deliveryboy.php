<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Deliveryboy extends Model
{
    //
    protected $fillable = [
        'name','mobile','address','masterid','password','lat_long',
    ];
}
