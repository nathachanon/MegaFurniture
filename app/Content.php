<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Content extends Model
{

  protected $fillable = [
      'admin_id','content_name','content_des','content_all','content_pic','content_status'
  ];
  protected $primaryKey = 'content_id';
  public $incrementing = true;
  }
