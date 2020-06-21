<?php

namespace App\Http\Controllers;

use App\cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function Cart($coupon = ''){
        $discount = 0;
        if ($coupon == ''){
            $user_ip = $_SERVER['REMOTE_ADDR'];
            $carts = cart::with('product')->where('user_ip',$user_ip)->get();
            session(['discount' => $discount]);
            return view('asif.frontend.cart',compact('carts','discount'));
        }else{
            if (Coupon::where('coupon_code',$coupon)->exists()){
                $valid = Coupon::where('coupon_code',$coupon)->first()->validity;
                if (Carbon::now()->format('Y-m-d') <= $valid){
                    $user_ip = $_SERVER['REMOTE_ADDR'];
                    $carts = cart::with('product')->where('user_ip',$user_ip)->get();

                    $discount = Coupon::where('coupon_code',$coupon)->first()->discount;
                    session(['discount' => $discount]);
                    return view('asif.frontend.cart',compact('carts','discount'))->with('CouponData','coupon valid');
                }
                else{
                    return "validity Expired";
                }
            }else{
                return "nai";
            }

        }

    }
function SingleCartDelete($cart_id){
    $user_ip = $_SERVER['REMOTE_ADDR'];
    cart::where('user_ip',$user_ip)->where('id',$cart_id)->delete();
    return back()->with('CartDelete','Cart Data Deleted Successfully');
}

function CartUpdate(Request $request)
{
    foreach ($request->cart_id as $key=>$item){
    cart::findOrFail($item)->update([
        'product_quantity'=>$request->product_quantity[$key],
        'updated_at'=>Carbon::now()
     ]);

  }
    return back()->with('UpdateData','Updated Data Successfully');
   }


}
