<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_thumbnail_photo;
use App\Models\SubCategory;
use Carbon\Carbon;
use Image;
class ProductController extends Controller
{
    function index(){
        return view('product.index', [
            'products' => Product::all(),
            'categories' => Category::all(),
            'subcategories' => SubCategory::all()
        ]);
    }

    function insert(Request $request){
        $product_id = Product::insertGetId([
            'category_id'           => $request->category_id,
            'sub_category_id'       => $request->sub_category_id,
            'product_name'          => $request->product_name,
            'product_description'   => $request->product_description,
            'product_price'         => $request->product_price,
            'product_quantity'      => $request->product_quantity,
            'created_at'            => Carbon::now()

        ]);


        $new_product_photo = $request->file('product_photo'); //get the photo
        $extention =  $new_product_photo->getClientOriginalExtension();
        $new_product_photo_name = $product_id . "." . $extention;
        Image::make($new_product_photo)->save(base_path('public/uploads/product_photos/' . $new_product_photo_name));
        //database update start
        Product::find($product_id)->update([
            'product_photo' => $new_product_photo_name
        ]);
        //database update end

        $start = 1;
        foreach ($request->file('product_thumbnail_photos') as $single_product_thumbnail_photo) {
            //echo $single_product_thumbnail_photo;


            $extention =  $single_product_thumbnail_photo->getClientOriginalExtension();
            $single_product_thumbnail_photo_name = $product_id . "-" . $start . "." . $extention;
            Image::make($single_product_thumbnail_photo)->save(base_path('public/uploads/product_thumbnail_photos/' . $single_product_thumbnail_photo_name));
            $start++;
            Product_thumbnail_photo::insert([
                'product_id' => $product_id,
                'product_thumbnail_photo_name' => $single_product_thumbnail_photo_name,
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('productuploadstatus', "Product uploaded successfully !!");
    }
}
