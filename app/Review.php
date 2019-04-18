<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

  protected $fillable = [
      'rating','description', 'buyer_id','prod_id'
  ];

   protected $primaryKey = 'review_id';
   public $incrementing = true;

   public function products()
  {
    return $this->belongsTo(Product::class);
  }
}
