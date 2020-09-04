<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public  $timestamps = false;

    public function Product()
    {
        return $this->hasMany('App\Product');
    }
}
