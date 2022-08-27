<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_order extends Model
{
    protected $fillable=['user_id','order_no','cust_name','mobile','address','amount','mop','area_id','status','time_slot'];
}
