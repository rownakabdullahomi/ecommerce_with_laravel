<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Cart;
use Carbon\Carbon;
use Cookie;

class CartController extends Controller
{
    function addtocart(Request $request){
        if(Cookie::get('generated_cart_id')){
            $randomly_generated_cart_id = Cookie::get('generated_cart_id');
        }
        else{
            $randomly_generated_cart_id = Str::random(6) . time();
            Cookie::queue(Cookie::make('generated_cart_id', $randomly_generated_cart_id, 7200)); //7200 min = 5 days
        }
        if(Cart::where('generated_cart_id', $randomly_generated_cart_id)->where('product_id', $request->product_id)->exists()){
            Cart::where('generated_cart_id', $randomly_generated_cart_id)->where('product_id', $request->product_id)->increment('cart_amount', $request->cart_amount);
        }
        else{
            Cart::insert([
                'generated_cart_id' => $randomly_generated_cart_id,
                'product_id' => $request->product_id,
                'cart_amount' => $request->cart_amount,
                'created_at' => Carbon::now()
            ]);
        }
        return back()->with('cartstatus', 'Product added to cart successfully !!');
    }

    function cartdelete($cart_id){
        Cart::find($cart_id)->delete();
        return back();
    }

    function cart(){

        return view('cart', [
            'cart_items' => Cart::where('generated_cart_id', Cookie::get('generated_cart_id'))->get()
        ]);
    }
}
