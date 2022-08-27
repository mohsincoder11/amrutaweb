<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $fillable=['name','address','mobno','email','pan','bankname','accno','ifsccode','shedsize','capacity','distance','geolocation',];
}
