<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    //
    protected $fillable = [
        'fullname','custtype','mobile','altmobile','address','masterid',
    ];
}
