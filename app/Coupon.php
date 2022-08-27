<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    protected $fillable=['coupon_code','coupon_type','value','min_amount','valid_from','valid_to',];
}
