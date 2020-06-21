<?php

namespace App\Http\Controllers;
use App\category;
use App\subcategory;

use Carbon\Carbon;
use Illuminate\Http\Request;

class subcontroller extends Controller
{
//    function __construct(){
//        $this->middleware('auth');
//    }
  function subcategory(){
      $category=category::orderBy('name','asc')->get();

  return view('asif.post.subcategory.subcategory',compact('category'));
  }



  function subcategorypost(request $request){
      subcategory::insert([
          'subname'=>$request->subname,
          'category_id'=>$request->category_id,
          'created_at'=>Carbon::now(),


      ]);
      return back()->with('success','subcategory updated succcessfully');

  }
  function subviewpost(){
      $scount=subcategory:: count();
      $subcategories = subcategory:: with('get_category')->paginate(5);
      return view('asif.post.subcategory.view_SubCategory',compact('subcategories','scount'));
  }
  function subdeletecat($id){
      subcategory::findOrFail($id)->delete();
      return back()->with('delete','subcategory deleted successfully');
  }
  function subupdatecat(){
      $cat=category::orderBy('name','asc')->get();
      $scat=subcategory::OrderBy('subname','asc')->get();
      return view('asif.post.subcategory.Editsubcategory',compact('cat','scat'));
  }
  function subupcategorypost(){
      subcategory::all();
      return view('asif.post.subcategory');
  }
  function subdeleted(){
      $scount=subcategory::onlyTrashed()->count();
      $subcategories = subcategory::onlyTrashed()->paginate(5);
      return view('asif.post.subcategory.deletedsub',compact('subcategories','scount'));

  }
  function subrestore($id){
      subcategory::withTrashed()->findOrFail($id)->restore();
      return back()->with('delete','Subcategory restore successfully');
  }
  function subpdelete($id){
      subcategory::withTrashed()->findOrFail($id)->forceDelete();
      return back()->with('delete','subcategory deleted parmanently');
  }
}
