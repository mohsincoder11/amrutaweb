<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_orderlist extends Model
{
        protected $fillable=['user_id','order_id','item_id','item_name','weight','total','delivery_status'];

}
