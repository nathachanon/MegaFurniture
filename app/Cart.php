<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $fillable = [
      'Buyer_id','NumOfProduct','Price'
  ];
}
