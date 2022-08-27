<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cancelorder extends Model
{
    //
     protected $fillable = [
        'masterid','teleorderid','orderdate','orderno','custname','mobile','details','shopname','address','mop','timetaken','timestatus','amount','paidstatus','collectedcash','assignto','deliveryboyid','reason',
    ];
}
