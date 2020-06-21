<?php

namespace App\Http\Controllers;

use App\WebInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class WebInfoController extends Controller
{
    function webinfo(){
        $webinfo=WebInfo::all();
          return view('asif.post.webinfo',compact('webinfo'));
  }

  function webinfopost(Request $request){
        WebInfo::Create([
             'email'=>$request->email,
             'Address'=>$request->Address,
             'phone'=>$request->phone,
             'telphone'=>$request->telphone,
             'copyright'=>$request->copyright,
             'description'=>$request->description,
             'created_at'=>Carbon::now()
           ]);
           return back()->with('success','INSERTED SUCCESSFULLY');

  }
}
