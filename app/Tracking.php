<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
  protected $fillable = [
      'track_id','order_detail_id','track_number','status'
  ];
}
