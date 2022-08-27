<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StockDispose extends Model
{
    protected $fillable = [
        'shop_id',
        'salable_chicken',
        'salable_g_k',
        'dispose_chicken',
        'dispose_g_k',
        'total_salable_chicken',
        'total_salable_g_k',
        'date',
        'time'
        

    ];
}
