<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable=['pid','date','time','vehicleno','vendor','refno','grn_id']; 
}
