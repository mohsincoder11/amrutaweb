<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    //
    protected $fillable = [
        'address','lat_long','shopname','masterid','userid','assign_area','opening_birds','birds_weights',
    ];
}
