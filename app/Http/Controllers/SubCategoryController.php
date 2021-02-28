<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\SubCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubCategoryController extends Controller
{
    function index(){

       // $categories = Category::latest()->get();
        $categories = Category::all();
        $sub_categories = SubCategory::paginate(2, ['*'], 'sub_categories');
        $total_sub_categories = SubCategory::count();
        $deleted_subcategories = SubCategory::onlyTrashed()->paginate(1, ['*'], 'deleted_subcategories');
        return view('subcategory.index', [
            'categories' => $categories,
            'subcategories' => $sub_categories,
            'total_sub_categories' => $total_sub_categories,
            'deleted_subcategories' => $deleted_subcategories
            ]);
    }
    function insert(Request $request){
        //print_r($request->all());
        $request->validate([
            'category_id' => 'required',
            'sub_category_name' => 'required|string|max:255'
            //'sub_category_name' => 'unique:sub_categories,sub_category_name'
        ]);

        if(SubCategory::withTrashed()->where('category_id', $request->category_id)->where('sub_category_name', $request->sub_category_name)->exists()){
            return back()->with('errorstatus', 'Sub-Category already exists !!');
        }
        else{
            SubCategory::insert([
                'category_id' => $request->category_id,
                'sub_category_name' => $request->sub_category_name,
                'created_at' => Carbon::now()
            ]);
            return back()->with('insertstatus', 'Sub-Category added successfully !!');
        }


    }

    function delete($subcategory_id)
    {
        //echo $subcategory_id;
        SubCategory::find($subcategory_id)->delete();
        return back()->with('deletestatus', 'Sub-Category deleted successfully !!');

    }
    function restore ($subcategory_id)
    {
        //echo $subcategory_id;
        SubCategory::onlyTrashed()->find($subcategory_id)->restore();
        return back()->with('restorestatus', 'Sub-Category restored successfully !!');

    }

    function permanentdelete($subcategory_id){
        SubCategory::onlyTrashed()->find($subcategory_id)->forceDelete();
        return back()->with('p.deletestatus', 'Sub-Category deleted permanently !!');
    }
    function markdelete (Request $request){
        if($request->mark_delete_id){

            foreach ($request->mark_delete_id as $single_mark_delete_id) {
                SubCategory::find($single_mark_delete_id)->delete();
            }
            return back()->with('markdeletestatus', 'Marked Sub-Category deleted successfully !!');
        }
        else{
            return back()->with('markdeleteerror', 'Please mark items to delete !!');
        }
    }

    function alldelete (){
        SubCategory::whereNotNull('id')->delete();
        return back()->with('alldelete', 'All data deleted successfully !!');
    }

    function edit($subcategory_id){
        return view('subcategory.edit', [
            'categories' => Category::all(),
            'subcategory_info' => SubCategory::find($subcategory_id)
        ]);
    }

    function update(Request $request){
        print_r($request->all());
        SubCategory::find($request->sub_category_id)->update([
            'category_id' => $request->category_id,
            'sub_category_name' => $request->sub_category_name
        ]);
        return back()->with('subcategoryupdate', 'Sub Category updated successfully !!');
    }

}
