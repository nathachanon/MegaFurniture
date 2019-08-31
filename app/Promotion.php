<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{

  protected $fillable = [
      'admin_id','promotion_name','promotion_des','promotion_pic','promotion_status'
  ];
  protected $primaryKey = 'promotion_id';
  public $incrementing = true;
  }
