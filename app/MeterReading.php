<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MeterReading extends Model
{
    protected $table='meter_reading';
    
    protected $fillable = [
        'user_id',
        'vehicle_no',
        'reading',
        'file',
        'status',
        'type'
    ];
}
