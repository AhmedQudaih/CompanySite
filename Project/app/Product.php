<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public  $timestamps = false;

    public function Category()
    {
        return $this->belongsTo('App\Category');
    }
    
    public function Cart()
    {
        return $this->belongsToMany('App\Cart');
    }
}
