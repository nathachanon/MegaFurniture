<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orderdetail extends Model
{
  protected $fillable = [
      'Order_id','Prod_id','del_price_id','requiredDate','price','Add_id','order_detail_id','count','status'
  ];
}
