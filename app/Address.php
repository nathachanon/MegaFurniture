<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{

  protected $fillable = [
      'buyer_id','area','district','province','zipcode','status'
  ];

}
