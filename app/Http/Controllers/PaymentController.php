<?php

namespace App\Http\Controllers;

use App\billings;
use App\product;
use App\sale;
use App\shipping;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\cart;
use App\Mail\OrderShipped;

class PaymentController extends Controller
{
    function Payment(Request $request){
        $sub_total=$request->session()->get('sub_total');
        $discount=$request->session()->get('discount');
        $grant_total=$sub_total-($sub_total/100)* $discount;
        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = cart::with('product')->where('user_ip',$user_ip)->get();

        $shipping_id=shipping::insertGetId([
            'user_id'=>Auth::user()->id,
            'first_name'=>$request->first_name,
            'last_name'=>$request->last_name,
            'company_name'=> $request->company_name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'country_id'=>$request->country_id,
            'state_id'=>$request->state_id,
            'city_id'=>$request->city_id,
            'address'=>$request->address,
            'postcode'=>$request->postcode,
            'notes'=>$request->notes,
            'created_at'=>Carbon::now()

        ]);
        $sale_id=sale::insertGetId([
            'user_id'=>Auth::user()->id,
            'shipping_id'=>$shipping_id,
            'grant_total'=> $sub_total,
            'discount'=> $discount,
            'created_at'=>Carbon::now()
          ]);

        $user_ip = $_SERVER['REMOTE_ADDR'];
        $carts = cart::where('user_ip',$user_ip)->get();
        foreach ($carts as $item){
            if (billings::where('product_id',$item->product_id)->exists()){

                billings::where('product_id',$item->product_id)->increment('product_quantity');
            }else{
                billings::insert([
                    'user_id'=>Auth::user()->id,
                    'sale_id'=>$sale_id,
                    'shipping_id'=>$shipping_id,
                    'product_id'=>$item->product_id,
                    'product_price'=>$grant_total,
                    'product_quantity'=>$item->product_quantity,
                    'created_at'=>Carbon::now()

                ]);

            }



        product::findOrFail($item->product_id)->decrement('product_quantity',$item->product_quantity);
        $item->delete();
        }
        \Stripe\Stripe::setApiKey('sk_test_aRXHFiuOGNmECByBqVSWD7wt00ban1U9Ro');

        \Stripe\Charge::create([
            'amount' => $sub_total*100,
            'currency' => 'usd',
            'source'=>$request->stripeToken,
        ]);

        $orderdata=billings::where('shipping_id',$shipping_id)->get();
        Mail::to(Auth::user()->email)->send(new OrderShipped($orderdata));
        return back()->with('CheakoutData','Cheakout Done..your billings data in your email plz cheak this..Thanks for shopping..');
    }
}
