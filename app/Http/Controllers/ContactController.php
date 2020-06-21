<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
   function contact(){
       return view('asif.frontend.contact');
   }
   function contactpost(Request $request){
       Contact::insert([
           'name'=>$request->name,
           'email'=>$request->email,
           'Subject'=>$request->Subject,
           'message'=>$request->message,

       ]);
       return back()->with('ContactData','Message Send Successfully');
   }

   function about(){

       return view('asif.frontend.about');
   }
}
