<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Rmproduct extends Model
{
  protected $table = 'Rmproducts';
  protected $fillable = [
      'CatProd_id','RM_value',
  ];
}
