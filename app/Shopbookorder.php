<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shopbookorder extends Model
{
    //
     protected $fillable = ['masterid','orderdate','orderno','orderid','mobile','details','mop','round_of','discount','amount','address',];
}
