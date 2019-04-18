<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
  protected $fillable = [
      'Cart_id','total_price','status','Add_id'
  ];
}
