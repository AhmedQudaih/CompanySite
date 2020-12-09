<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public $timestamps = false;

    public function Order()
    {
        return $this->belongsTo('App\Order');
    }
}
