<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product_in_cart extends Model
{
  protected $fillable = [
      'Cart_id','Prod_id','count'
  ];
}
