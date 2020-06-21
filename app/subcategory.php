<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class subcategory extends Model
{

    use SoftDeletes;

    protected $fillable = ['subname','category_id'];

    function get_category(){
        return $this->belongsTo('App\category','category_id');
    }



}
