<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\features;
use carbon\carbon;
use Image;

class FeatureController extends Controller
{
    public function feature_Add(){
        return view('asif.post.Feature.Add_feature');
    }

    public function feature_post(request $request){

        $request->validate([
            'name'=>'required',
            'image'=>'required',
        ]);


        $slug = strtolower(str_replace(' ','-',$request->name));

        $uniq = features::where('slug',$slug)->count();

        if ($uniq>0){
            $slug = $slug.'-'.time();
        }

        if($request->hasFile('image')){
            $image = $request->file('image');

            $full_name = $slug.'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(600,472)->save(public_path('feature_image/'.$full_name));

            features::insert([

                'name'=>$request->name,
                'image'=>$full_name,
                'slug'=>$slug,
                'created_at'=>carbon::now(),
            ]);


            return redirect()->back()->with('success','succes');

        }else{

            features::insert([

                'name'=>$request->name,
                'created_at'=>carbon::now(),
            ]);


            return redirect()->back()->with('success','succes');

        }
    }

    public function feature_view(){

        $view = features::paginate(5);
        return view('asif.post.Feature.feature_view',['view'=>$view]);
    }

    function feature_delete($id){
       features::findOrFail($id)->delete();
        return back()->with('delete','Deleted');
    }

    function feature_update($id){
        $values=features::findOrFail($id);
        return view('asif.post.Feature.update_feature',compact('values'));
    }

    function feature_update_post(Request $request,$id)
    {
        $role = [
            'name' => 'required|min:4',
        ];

        $slug = strtolower(str_replace(' ', '-', $request->name));

        $uniq = features::where('slug',$slug)->count();

        if ($uniq > 0) {
            $slug = $slug.'-'.time();
        }
        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $full_name = $slug.'.'.$image->getClientOriginalExtension();

            Image::make($image)->resize(600, 472)->save(public_path('feature_image/'. $full_name));

            features::find($id)->update([
                'name'=>$request->name,
                'image'=>$full_name,
            ]);
            return redirect()->route('feature_view')->with('success','updated');
        }
    }
}


