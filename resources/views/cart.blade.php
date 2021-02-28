@extends('layouts.tohoney')

@section('content')

<!-- .breadcumb-area start -->
    <div class="breadcumb-area bg-img-4 ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="breadcumb-wrap text-center">
                        <h2>Shopping Cart</h2>
                        <ul>
                            <li><a href="index.html">Home</a></li>
                            <li><span>Shopping Cart</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .breadcumb-area end -->
    <!-- cart-area start -->
    <div class="cart-area ptb-100">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <form action="http://themepresss.com/tf/html/tohoney/cart">
                        <table class="table-responsive cart-wrap">
                            <thead>
                                <tr>
                                    <th class="images">Image</th>
                                    <th class="product">Product</th>
                                    <th class="ptice">Price</th>
                                    <th class="quantity">Quantity</th>
                                    <th class="total">Total</th>
                                    <th class="remove">Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $total = 0;
                                @endphp
                                @foreach ($cart_items as $cart_item)
                                    <tr>
                                        <td class="images"><img src="{{ asset('uploads/product_photos') }}/{{ App\Models\Product::find($cart_item->product_id)->product_photo }}" alt=""></td>
                                        <td class="product"><a target="_blank" href="{{ url('product/details') }}/{{ $cart_item->product_id }}">{{ App\Models\Product::find($cart_item->product_id)->product_name }}</a></td>
                                        <td class="ptice">{{ App\Models\Product::find($cart_item->product_id)->product_price }}</td>
                                        <td class="quantity cart-plus-minus">
                                            <input type="text" value="{{ $cart_item->cart_amount }}" />
                                        </td>
                                        <td class="total">
                                            ${{ App\Models\Product::find($cart_item->product_id)->product_price * $cart_item->cart_amount }}
                                        </td>
                                        <td class="remove">
                                            <a href="{{ url('cart/delete') }}/{{ $cart_item->id }}">
                                                <i class="fa fa-times"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @php
                                        $total = $total + (App\Models\Product::find($cart_item->product_id)->product_price * $cart_item->cart_amount);
                                    @endphp
                                @endforeach


                            </tbody>
                        </table>
                        <div class="row mt-60">
                            <div class="col-xl-4 col-lg-5 col-md-6 ">
                                <div class="cartcupon-wrap">
                                    <ul class="d-flex">
                                        <li>
                                            <button>Update Cart</button>
                                        </li>
                                        <li><a href="{{ url('shop') }}">Continue Shopping</a></li>
                                    </ul>
                                    <h3>Cupon</h3>
                                    <p>Enter Your Cupon Code if You Have One</p>
                                    <div class="cupon-wrap">
                                        <input type="text" placeholder="Cupon Code">
                                        <button>Apply Cupon</button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                                <div class="cart-total text-right">
                                    <h3>Cart Totals</h3>
                                    <ul>
                                        <li><span class="pull-left">Total </span>{{ $total }}</li>
                                        <li><span class="pull-left">Discount </span>80.00</li>
                                        <li><span class="pull-left"> Subtotal </span>$300.00</li>
                                    </ul>
                                    <a href="checkout.html">Proceed to Checkout</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- cart-area end -->



@endsection
