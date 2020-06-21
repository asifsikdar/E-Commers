<?php

namespace App\Http\Controllers;

use App\product;
use App\Wishlist;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    function wishlist(){
         $user_ip=$_SERVER['REMOTE_ADDR'];
         $wishes=Wishlist::with('product')->where('user_ip',$user_ip)->get();
        return view('asif.frontend.wishlist',compact('wishes'));
    }

    function singlewishlist($product_id){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        if (Wishlist::where('product_id',$product_id)->where('user_ip',$user_ip)->exists()){
            Wishlist::where('product_id',$product_id)->where('user_ip',$user_ip)->increment('product_quantity');
        }
        else{
            Wishlist::insert([
                'product_id'=>$product_id,
                'user_ip'=>$user_ip,
                'created_at' =>Carbon::now(),
            ]);
        }
        return back();
    }

    function singlewishlistdelete($id){
        $user_ip=$_SERVER['REMOTE_ADDR'];
        Wishlist::where('user_ip',$user_ip)->where('id',$id)->delete();
        return back()->with('WishlistDelete','Deleted');
    }
}
