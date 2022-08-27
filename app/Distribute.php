<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Distribute extends Model
{
    protected $fillable=['date','time','user_id','vehno','drivername','noofbirds','totalwt','avgbirdwt',
'shopcutunit','openingbirds'];
}
