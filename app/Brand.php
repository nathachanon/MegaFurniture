<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
  protected $fillable = [
      'seller_id','brand_name','brand_des','brand_status','brand_logo',
  ];
}
