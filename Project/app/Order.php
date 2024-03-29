<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    public  $timestamps = false;

    public function User()
    {
        return $this->belongsTo('App\User');
    }
    public function Items()
    {
        return $this->hasMany('App\Items');
    }

}
