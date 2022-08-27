<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoporderlist extends Model
{
    //
    protected $fillable = [
        'orderid','itemname','weight','rate','masterid',
    ];
}
