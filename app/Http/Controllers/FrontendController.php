<?php

namespace App\Http\Controllers;

use App\billings;
use App\cart;
use App\category;
use App\product;
use Illuminate\Support\Facades\Auth;
use App\Review;
use App\User;
use App\VisitorCount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use function Sodium\increment;
use App\features;

class FrontendController extends Controller
{
    function FrontPage(){
        $product=product::all();

         $feature = features::get();

        return view('asif.frontend.main',compact('product','feature'));
    }
    function SingleProduct($slug){
        $product=product::where('slug',$slug)->first();



        session(['slug'=>$product->slug]);
        session(['id'=>$product->id]);

        $related_product=product::where('category_id',$product->category_id)->limit(4)->inRandomOrder()->get();
        $user_ip = $_SERVER['REMOTE_ADDR'];

        $count= VisitorCount::where('product_id',$product->id)->where('user_ip',$user_ip)->first();
        if ($count){
            VisitorCount::where('product_id',$product->id)->where('user_ip',$user_ip);
        }else{
            VisitorCount::increment('visited');
            VisitorCount::insert([
                'product_id'=>$product->id,
                'user_ip'=>$user_ip,
                'visited'=>1
            ]);
        }

        $review = Review::where('slug',$product->slug)->OrderBy('id','desc')->take(5)->get();
        $reviewvalidate = billings::where('user_id',auth::user()->id ?? '')->where('product_id',$product->id)->exists();
        return view('asif.frontend.single_product',compact('product','related_product','review','reviewvalidate'));


    }
    function shop(){
        $categories=category::orderBy('name','asc')->get();
        $products=product::orderBy('product_name','asc')->get();
        return view('asif.frontend.shop',compact('categories','products'));
    }

 function SingleCart($product_id){
     $user_ip = $_SERVER['REMOTE_ADDR'];
     if (cart::where('product_id',$product_id)->where('user_ip',$user_ip)->exists()){
          cart::where('product_id',$product_id)->where('user_ip',$user_ip)->increment('product_quantity');
     }
     else {
         cart::insert([
             'product_id' => $product_id,
             'user_ip' => $user_ip,
             'created_at' => Carbon::now()
         ]);
     }
     return back();
 }
}
