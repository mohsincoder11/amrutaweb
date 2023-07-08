<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Shopbookorder extends Model
{
    //

     protected $fillable = ['masterid','orderdate','orderno','orderid','mobile','details','mop','round_of','discount','amount','address',];

     public function shopOrderLists()
     {
         return $this->hasMany(Shoporderlist::class, 'orderid', 'orderid');
     }
 
     public function shops()
     {
         return $this->belongsTo(Shop::class, 'masterid', 'userid');
     }

}
