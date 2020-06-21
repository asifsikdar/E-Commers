<?php

namespace App\Http\Controllers;

use App\billings;
use App\cart;
use App\City;
use App\Country;
use App\State;
use App\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\RequestStack;

class CheakoutController extends Controller
{
   function __construct()
   {
       $this->middleware('auth');
   }

    function cheakout(Request $Request){
        $auth_user = Auth::user();
        $countries=Country::orderBy('name','asc')->get();
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = cart::with('product')->where('user_ip',$user_ip)->get();
        $sub_total=0;
        foreach ($carts as $cart){
            $sub_total += $cart->product->product_price * $cart->product_quantity;
        }
        session(['sub_total' => $sub_total]);

      $discount =$Request->session()->get('discount');

        return view('asif.frontend.cheakout',compact('auth_user','countries','sub_total','discount'));
        }
    function GetStateList($country_id){
        $states=State::where('country_id',$country_id)->get();
        return response()->json($states);
    }
    function GetCityList($state_id){
        $cities=City::where('state_id',$state_id)->get();
        return response()->json($cities);
    }
}
