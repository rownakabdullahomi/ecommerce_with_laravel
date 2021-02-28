<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;


Route::get('/', [FrontendController::class, 'index']);
Route::get('product/details/{product_id}', [FrontendController::class, 'product_details']);
Route::get('shop', [FrontendController::class, 'shop']);
Route::get('shop/category/{category_id}', [FrontendController::class, 'shop_category']);

Route::get('about', [FrontendController::class, 'about']);
Route::get('contact', [FrontendController::class, 'contact']);


Auth::routes();

Route::get('home', [HomeController::class, 'index'])->name('home');

Route::get('category', [CategoryController::class, 'index']);
Route::post('category/insert', [CategoryController::class, 'insert']);
Route::get('category/delete/{category_id}', [CategoryController::class, 'delete']);

Route::get('subcategory', [SubCategoryController::class, 'index']);
Route::post('subcategory/insert', [SubCategoryController::class, 'insert']);
Route::get('subcategory/delete/{subcategory_id}', [SubCategoryController::class, 'delete']);
Route::get('subcategory/edit/{subcategory_id}', [SubCategoryController::class, 'edit']);
Route::post('subcategory/update/{subcategory_id}', [SubCategoryController::class, 'update']);
Route::get('subcategory/restore/{subcategory_id}', [SubCategoryController::class, 'restore']);
Route::get('subcategory/permanent/delete/{subcategory_id}', [SubCategoryController::class, 'permanentdelete']);
Route::post('subcategory/mark/delete', [SubCategoryController::class, 'markdelete']);
Route::get('subcategory/all/delete', [SubCategoryController::class, 'alldelete']);

Route::get('editporfile', [ProfileController::class, 'index']);
Route::post('editporfile/name/change', [ProfileController::class, 'namechange']);
Route::post('editporfile/password/change', [ProfileController::class, 'passwordchange']);
Route::post('editporfile/photo/change', [ProfileController::class, 'photochange']);

Route::get('product', [ProductController::class, 'index']);
Route::post('product/insert', [ProductController::class, 'insert']);

Route::post('add/to/cart', [CartController::class, 'addtocart']);
Route::get('cart/delete/{cart_id}', [CartController::class, 'cartdelete']);
Route::get('cart', [CartController::class, 'cart']);

