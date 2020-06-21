<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

    protected  $fillable= [

        'category_id',
          'subcategory_id',
          'product_name',
          'product_summary',
          'product_price',
          'product_quantity',
          'product_description',
          'slug',
          'product_thumbnail',
    ];

    function get_category(){
        return $this->belongsTo('App\category','category_id');
    }

    function get_subcategory(){
        return $this->belongsTo('App\subcategory','subcategory_id');
    }
}
