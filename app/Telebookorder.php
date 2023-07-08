<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Telebookorder extends Model
{
    //
    protected $fillable = [
        'masterid', 'orderdate', 'orderno', 'orderid', 'user_id', 'custname', 'mobile', 'altmobile', 'details',
        'address', 'lat_long', 'area_id', 'shopname', 'mop', 'timetaken', 'timestatus', 'amount', 'collectedcash', 'paidstatus',
        'status', 'assignto', 'deliveryboyid', 'orderfrom', 'time_slot', 'delivery_charge'
    ];
    protected $dates = ['expired_at'];

    public function teleorderlists()
    {
        return $this->hasMany(Teleorderlist::class, 'orderid');
    }

    public function specialteleorderlists()
    {
        
        return $this->hasMany(Teleorderlist::class, 'orderid', 'orderid');
    }
}
