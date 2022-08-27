<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stos extends Model
{
    protected $fillable=['date','time','targetshop','sourceshop','vehicleno','drivername','livebird','totalwt','avgwt','rawchicken',];
}
