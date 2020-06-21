<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $fillable=['product_quantity','product_id'];

    function product(){
        return $this->belongsTo('App\product','product_id');
    }
}
