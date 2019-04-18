<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class bank_account extends Model
{

  protected $fillable = [
      'bank_id','brand_id','bank_account','account_name','status'
  ];

}
