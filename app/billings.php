<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class billings extends Model
{
    protected $fillable=[
        'user_id',
        'sale_id',
        'shipping_id',
        'product_id',
        'product_price',
        'product_quantity',
       ];
    function product(){
        return $this->belongsTo('App\product','product_id');
    }
}
