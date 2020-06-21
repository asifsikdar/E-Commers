<?php

namespace App\Http\Controllers;

use App\category;
use App\product;
use App\ProductGallary;
use App\subcategory;
use Carbon\Carbon;
use function GuzzleHttp\Psr7\str;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Image;


class ProductController extends Controller
{
    function product()
    {
        $categories = category::orderBy('name', 'asc')->get();
        $subcategories = subcategory::orderBy('subname', 'asc')->get();
        return view('asif.post.product.product', compact('subcategories', 'categories'));
    }

    function productpost(Request $request)
    {
        $slug = strtolower(str_replace(' ', '-', $request->product_name));

        $checkit = product::where('slug', $slug)->count();

        if ($checkit > 0) {
            $slug = $slug . '-' . time();
        }

        if ($request->hasFile('product_thumbnail')) {
            $image = $request->file('product_thumbnail');
            $ext = $slug . '.' . $image->getClientOriginalExtension();
            Image::make($image)->resize(600, 622)->save(public_path('img/thumbnail/' . $ext));
            $product_id = product::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_summary' => $request->product_summary,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_description' => $request->product_description,
                'slug' => $slug,
                'product_thumbnail' => $ext,
                'created_at' => Carbon::now(),

            ]);
            if ($request->hasFile('product_galary')) {
                $img = $request->file('product_galary');
                foreach ($img as $key => $item) {
                    $ext1 = time() . $key . '.' . $item->getClientOriginalExtension();
                    Image::make($item)->resize(600, 622)->save(public_path('img/gallery/' . $ext1));
                    ProductGallary::insert([
                        'product_id' => $product_id,
                        'product_galary' => $ext1,
                        'created_at' => Carbon::now()
                    ]);

                }
            }
            return back()->with('success', 'product inserted successfully');
        } else {
            $product_id = product::insertGetId([
                'category_id' => $request->category_id,
                'subcategory_id' => $request->subcategory_id,
                'product_name' => $request->product_name,
                'product_summary' => $request->product_summary,
                'product_price' => $request->product_price,
                'product_quantity' => $request->product_quantity,
                'product_description' => $request->product_description,
                'slug' => $slug,
//                'product_thumbnail' => $ext,
                'created_at' => Carbon::now(),

            ]);

            if ($request->hasFile('product_galary')) {
                $img1 = $request->file('product_galary');
                foreach ($img1 as $key => $item2) {
                    $ext2 = time() . $key . '.' . $item2->getClientOriginalExtension();
                    Image::make($item2)->resize(600, 622)->save(public_path('img/gallery/' . $ext2));
                    ProductGallary::insert([
                        'product_id' => $product_id,
                        'product_galary' => $ext2,
                        'created_at' => Carbon::now()
                    ]);
                }
            }

            return back()->with('success', 'product inserted successfully');
        }
    }


        
        function productupdate(Request $request)
        {
            $id = $request->session()->get('pro_id');
            $old_product = product::findOrFail($id);
            $slug = $old_product->slug;
            $old_img = $old_product->product_thumbnail;


            if ($request->hasFile('product_thumbnail')) {
                $image = $request->file('product_thumbnail');


                $ext = $slug . '.' . $image->getClientOriginalExtension();


                if (file_exists(public_path('img/thumbnail/') . $old_img)) {
                    unlink(public_path('img/thumbnail/') . $old_img);
                }
                Image::make($image)->resize(600, 622)->save(public_path('img/thumbnail/' . $ext));
                     product::findOrFail($id)->update([
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'product_name' => $request->product_name,
                    'product_summary' => $request->product_summary,
                    'product_price' => $request->product_price,
                    'product_quantity' => $request->product_quantity,
                    'product_description' => $request->product_description,
                    'product_thumbnail' => $ext,
                    'created_at' => Carbon::now(),

                ]);

                $gellery_olds = ProductGallary::find($id);

                $old = $gellery_olds->product_galary;

                if ($request->hasFile('product_galary')) {

                    $img1 = $request->file('product_galary');

                    if (file_exists(public_path('img/gallery/'.$old))){
                        unlink(public_path('img/gallery/'.$old));
                    }
                    foreach ($img1 as $key => $item2) {
                        $ext3 = time() . $key . '.' . $item2->getClientOriginalExtension();
                        Image::make($item2)->resize(600, 472)->save(public_path('img/gallery/' . $ext3));
                        ProductGallary::findOrFail($id)->update([

                            'product_galary' => $ext3,
                            'created_at' => Carbon::now()
                        ]);

                    }
                }
                return redirect()->route('productpostview')->with('update', 'product update successfully');

            } else {
                $product_id= product::findOrFail($id)->update([
                    'category_id' => $request->category_id,
                    'subcategory_id' => $request->subcategory_id,
                    'product_name' => $request->product_name,
                    'product_summary' => $request->product_summary,
                    'product_price' => $request->product_price,
                    'product_quantity' => $request->product_quantity,
                    'product_description' => $request->product_description,

                    'created_at' => Carbon::now(),
//                'product_thumbnail' => $ext
                ]);




                return redirect()->route('productpostview')->with('update', 'product update successfully');

            }
        }

        function productdelete($cat_id)
        {
            product::findOrFail($cat_id)->delete();
            return back()->with('delete', 'product deleted successfully');
        }



        function Productview(){
        $products = product::paginate(4);
        return view('asif.post.product.view_product',compact('products'));
    }


    function productedit($pro_id){
      $categories = category::all();
      $subcategories = subcategory::all();
      $product = product::findOrFail($pro_id);
      session(['pro_id' => $pro_id]);
      return view('asif.post.product.edit_product',compact('categories','subcategories','product'));
    }




}

