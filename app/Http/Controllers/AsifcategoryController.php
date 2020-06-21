<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\category;


class AsifcategoryController extends Controller
{
//    function __construct(){
//        $this->middleware('verified');
//    }
    function category(){
        return view('asif.post.category');
    }


    function categorypost(request $request){

        $role=[
            'name'=>'required|min:4',
//            'email'=>'required|email',
//            'address'=>'required|min:10',
//            'phone'=>'required|min:11|max:16'
        ];
        $this->validate($request,$role);
        $cat=new category;
        $cat->name=$request->name;
//        $cat->email=$request->email;
//        $cat->address=$request->address;
//        $cat->phone=$request->phone;
        $cat->save();
        return back()->with('success','Category Added successfully');
    }
    function viewpost(){
        $category =  category::orderBy('name','asc')->paginate(5);
        return view('asif.post.view',compact('category'));

    }
    function deletecat($id){
        category::findOrFail($id)->delete();
        return back()->with('delete','category deleted successfully');
    }
    function updatecat($id){
        $category=category::findOrFail($id);
        return view('asif.post.editcategory',compact('category'));
    }
    function upcategorypost(request $request, $id){

        $role=[
            'name'=>'required|min:4',
//            'email'=>'required|email',
//            'address'=>'required|min:5',
//            'phone'=>'required|min:11|max:16'
        ];
        $this->validate($request,$role);

        category::find($id)->update($request->all());

        return redirect()->back()->with('success','data update succesfully');

    }
}
