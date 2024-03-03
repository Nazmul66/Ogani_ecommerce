@php
    $cartlists  =  App\Models\Cart::where('user_id', Auth::id() )->where('order_id', NULL)->get();

    //total amount
    $total_amount = 0;
    foreach ($cartlists as $cartlist) {
        $products   =  App\Models\Product::where('id', $cartlist->product_id)->get();

        foreach ($products as $product) {
            if( $product->discount_price ){
                $total_amount += $cartlist->product_qty * $product->discount_price;
            }
            else{
                $total_amount += $cartlist->product_qty * $product->selling_price;
            }
        }
    }
@endphp

@extends('frontend.layout.template')

@section('page-title')
   <title>Shopping Cart | Ecommerce</title>
@endsection

@section('body-content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Shopping Cart</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('homePage') }}">Home</a>
                            <span>Shopping Cart</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Shoping Cart Section Begin -->
    <section class="shoping-cart spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shoping__cart__table">

                      @if ( $carts->count() === 0 )
                        <div class="alert alert-danger text-center" role="alert">
                            There is no cart data available right now!
                        </div>

                      @else
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($carts as $cart)

                                @php
                                    $products  =  App\Models\Product::where('id', $cart->product_id)->get();
                                @endphp

                                    @foreach ($products as $product)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('backend/uploads/products/' . $product->thumbnail) }}" alt="" style="width: 125px;">
                                            <h5>{{ $product->product_name }}</h5>
                                        </td>
                                        <td class="shoping__cart__price">
                                            @if ( $product->discount_price )
                                               {{ $setting->currency }}{{ $product->discount_price }}
                                            @else
                                               {{ $setting->currency }}{{ $product->selling_price }}
                                            @endif
                                        </td>
                                        <td class="shoping__cart__quantity">
                                            <div class="quantity">
                                                <div class="pro-qty">
                                                    <input type="text" value="{{ $cart->product_qty }}" >
                                                </div>
                                            </div>
                                        </td>
                                        <td class="shoping__cart__total">
                                            @if ( $product->discount_price )
                                               {{ $setting->currency }}{{ $product->discount_price * $cart->product_qty }}
                                            @else
                                               {{ $setting->currency }}{{ $product->selling_price * $cart->product_qty }}
                                            @endif
                                        </td>
                                        <td class="shoping__cart__item__close">
                                            <a href="{{ route('cart.destroy', $cart->id) }}">
                                                <span class="icon_close"></span>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                      @endif

                    </div>

                    {{-- Cart updates and continue --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="#" class="primary-btn cart-btn">CONTINUE SHOPPING</a>
                                <a href="#" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                    Upadate Cart</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            
            
            <div class="row">  
                <div class="col-lg-6">
                    @if (Session::has('coupon')) 
                    @else
                    <div class="shoping__continue">
                        <div class="shoping__discount">
                            <h5>Discount Coupon Codes</h5>
                            <form method="post" action="{{ route('cart.coupon.apply') }}">
                                @csrf
                                <input type="text" name="coupon" placeholder="Enter your coupon code">
                                <button type="submit" class="site-btn">APPLY COUPON</button>
                            </form>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="col-lg-6">
                    <div class="shoping__checkout">
                        <h5>Cart Total</h5>
                        <ul>
                            @if (Session::has('coupon'))
                               <li>Subtotal <span>{{ $setting->currency }}{{ $total_amount }}</span></li>
                               <li>Discount(%) <span>{{ $setting->currency }}{{ Session::get('coupon')['coupon_discount'] }}</span></li>
                            @else
                               <li>Subtotal <span>{{ $setting->currency }}{{ $total_amount }}</span></li>
                            @endif

                            @if (Session::has('coupon'))
                               <li>Total <span>{{ $setting->currency }}{{ $total_amount - Session::get('coupon')['coupon_discount'] }}</span></li>
                            @else
                               <li>Total <span>{{ $setting->currency }}{{ $total_amount }}</span></li>
                            @endif
                        </ul>
                        <a href="#" class="primary-btn">PROCEED TO CHECKOUT</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection