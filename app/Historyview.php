<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Historyview extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'history_view';

    protected $fillable = [
        'buyer_id', 'prod_id'
    ];
}
