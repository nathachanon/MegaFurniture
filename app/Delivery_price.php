<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Delivery_price extends Model
{

  protected $fillable = [
      'Prod_id','Delivery_id','Price'
  ];

}
