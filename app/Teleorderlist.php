<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teleorderlist extends Model
{
  //
  protected $fillable = [
    'masterid', 'user_id', 'orderid', 'itemname', 'item_id', 'weight', 'rate', 'deliveryboyid',
    'delivery_status', 'orderfrom',
  ];

  public function telebookorder()
  {
    return $this->belongsTo(Telebookorder::class, 'orderid');
  } 
  
  public function telebookorder2()
  {
    return $this->belongsTo(Telebookorder::class, 'orderid','id');
  }

}
