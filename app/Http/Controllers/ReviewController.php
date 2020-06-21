<?php

namespace App\Http\Controllers;

use App\billings;
use App\Review;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    function review(Request $request){


        $request->validate([
            'stars'=>'required',
            'name'=>'required',
            'email'=>'required |email',
            'review'=>'required',
        ]);

        $slug = $request->session()->get('slug');
        $ids = $request->session()->get('id');

        Review::insert([
            'name'=>$request->name,
            'stars'=>$request->stars,
            'email'=>$request->email,
            'review'=>$request->review,
            'slug'=>$slug,
            'page_id'=>$ids,
            'created_at'=>Carbon::now(),
        ]);


        return back();
    }
}
