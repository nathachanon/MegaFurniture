<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sizeproduct extends Model
{

  protected $fillable = [
      'CatProd_id','SizeProd_width','SizeProd_length','SizeProd_height','SizeProd_foot',
  ];
}
