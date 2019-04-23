<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
  protected $fillable = [
      'BankAccount_id','order_detail_id','date_time','amount','pay_status','bank_account','bank_name'
  ];
}
