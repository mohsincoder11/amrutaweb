<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CoupanMaster extends Model
{
    protected $table='coupon-masters';
    protected $fillable=[
        'coupon_code',
        'min_amount',
        'discount_percent',
        'max_discount',
        'title',
        'status',
    ];
}
