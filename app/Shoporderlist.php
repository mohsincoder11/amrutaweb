<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Shoporderlist extends Model
{
    //
    protected $fillable = [
        'orderid','itemname','weight','rate','masterid',
    ];

    public function shopBookOrder()
    {
        return $this->belongsTo(Shopbookorder::class, 'orderid', 'orderid');
    }


}
