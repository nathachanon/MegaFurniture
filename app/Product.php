<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

  protected $fillable = [
      'brand_id','prod_name','prod_desc','prod_price','qty','CatProd_id','SizeProd_id','ColorProd_id','RM_id','show','status','dhl','ems','kerry','seller','buyer','sb','weight','pic_url1','pic_url2','pic_url3','pic_url4','pic_url5','sku'
  ];

  protected $primaryKey = 'Prod_id';
  public $incrementing = true;

   public function reviews()
    {
      return $this->hasMany(Review::class,'Prod_id');
    }
}
