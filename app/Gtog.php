<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Gtog extends Model
{
    protected $fillable=['date','time','targetgod','sourcegod','vehicleno','drivername','livebird','totalwt','avgwt',];
}
