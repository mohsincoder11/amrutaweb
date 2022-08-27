<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dailysuper extends Model
{
    protected $fillable=['date','time','openingbirds','feedconsumption','avgbirdwt','mortality','closingbird','user_id'];
}
