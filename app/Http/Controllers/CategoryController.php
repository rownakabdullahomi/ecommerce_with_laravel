<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use function PHPUnit\Framework\returnSelf;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Product;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index(){
        $categories = Category::paginate(3);
        //$categories = Category::latest()->get();
        $total_categories = Category::count();
        return view('category.index', compact("categories", "total_categories"));
    }
    function insert(Request $request){
        $request->validate([
            'category_name' => 'required|unique:categories,category_name'
        ],[
            'category_name.required' => 'Category Koi?',
            'category_name.unique' => 'Duplicate category name'
        ]);
        Category::insert([
            'category_name' => $request->category_name,
            'added_by'      => Auth::id(),
            'created_at'    => Carbon::now()
        ]);

        return back()->with('insertstatus', 'Category added successfully !!');
    }

    function delete($category_id){
        Category::find($category_id)->delete();
        SubCategory::where([
            'category_id' => $category_id
        ])->forceDelete();
        Product::where([
            'category_id' => $category_id
        ])->delete();
        return back()->with('deletestatus', 'Category deleted successfully !!');
    }
}
