<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_cancel_order extends Model
{
   protected $fillable=['app_order_id','reason'];
}
