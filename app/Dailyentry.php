<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dailyentry extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'time',
        'openingbirds',
        'salegbird',
        'salegwt',
        'billqtywt',
        'mortality',
        'wt',
        'closingbird',
        'tsaleamt',
        'disamt',
        'stock_chick_sale',
        'stock_g_k_sale',
        'meat_percent',
        'deposit_amount_bank',
        'deposit_amount_office',
        'deposit_amount_phonepay',
        'expenses',
        'closing_amount',
        'opening_amount'
    ];
}
