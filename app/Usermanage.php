<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Usermanage extends Model
{
    //
     protected $fillable = [
        'email','username','password','role','master','shop','telecaller','report','uniqueprefix',
    ];
}
