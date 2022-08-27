<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Stog extends Model
{
    protected $fillable=['date','time','targetgod','sourceshop','vehicleno','drivername','livebird','totalwt','avgwt',];
}
