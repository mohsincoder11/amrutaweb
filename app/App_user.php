<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class App_user extends Model
{
    protected $fillable=['full_name','email','pass','mob','address','image','area_id'];

}
