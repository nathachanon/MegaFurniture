<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword extends Model
{
  protected $fillable = [
      'keyword_value_id','Prod_id'
  ];
  protected $primaryKey = 'keyword__id';
  public $incrementing = true;
}
