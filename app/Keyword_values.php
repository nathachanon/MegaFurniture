<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Keyword_values extends Model
{
  protected $fillable = [
      'keyword_value'
  ];
  protected $primaryKey = 'keyword_value_id';
  public $incrementing = true;
}
