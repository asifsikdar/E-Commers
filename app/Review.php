<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected  $table ='reviews';
    protected $fillable=['stars','name','email','review','slug','page_id'];
}

