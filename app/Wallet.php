<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $fillable = [
        'user_id',
        'order_id',
        'credit',
        'total_credit',
        'used_credit',
        'status'
    ];
}
