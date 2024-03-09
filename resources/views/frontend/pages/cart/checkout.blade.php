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
   <title>Checkout Page | Ecommerce</title>
@endsection

@section('body-content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Checkout</h2>
                        <div class="breadcrumb__option">
                            <a href="./index.html">Home</a>
                            <span>Checkout</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout Section Begin -->
    <section class="checkout spad">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h6><span class="icon_tag_alt"></span> Have a coupon? <a href="#">Click here</a> to enter your code
                    </h6>
                </div>
            </div>
            <div class="checkout__form">
                <h4>Billing Details</h4>
                <form method="post" action="{{ route('order.place') }}">

                    @csrf

                    <input type="hidden" name="subtotal" value="{{ $total_amount }}">
                    <input type="hidden" name="total" value="{{ $total_amount }}">

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>First Name<span>*</span></p>
                                        <input type="text" name="c_name" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Last Name<span>*</span></p>
                                        <input type="text"  name="" autocomplete="off"> 
                                    </div>
                                </div>
                            </div>
                            
                            <div class="checkout__input">
                                <p>Country<span>*</span></p>
                                <input type="text" name="c_country" autocomplete="off">
                            </div>
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="c_address" autocomplete="off" placeholder="Street Address" class="checkout__input__add">
                                <input type="text" name="c_address_optional" autocomplete="off" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>
                            <div class="checkout__input">
                                <p>Town/City<span>*</span></p>
                                <input type="text" name="c_city" autocomplete="off">
                            </div>
                            <div class="checkout__input">
                                <p>Country/State<span>*</span></p>
                                <input type="text"  name="" autocomplete="off">
                            </div>
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text"  name="c_zipCode" autocomplete="off">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="c_phone" autocomplete="off">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone (Optional)<span>*</span></p>
                                        <input type="text" name="c_phone_optional" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="email"  name="c_email" autocomplete="off">
                            </div>

                            <div class="checkout__input">
                                <p>Order notes<span>*</span></p>
                                <input type="text"
                                    placeholder="Notes about your order, e.g. special notes for delivery.">
                            </div>
                        </div>

                        {{-- order details for your customer --}}
                        <div class="col-lg-4 col-md-6">
                            <div class="checkout__order">
                                <h4>Your Order</h4>
                                <div class="checkout__order__products">Products <span>Amount</span></div>
                                <ul>
                                    @foreach ($carts as $cart)
                                       @php
                                           $products = App\Models\Product::where('id', $cart->product_id)->first();
                                           $product_Name = substr($products->product_name, 0, 10);
                                       @endphp
                                       @if ( $products->discount_price )  
                                           <li>{{ $product_Name }} ( {{ $setting->currency }}{{ $products->discount_price}} * {{ $cart->product_qty }}{{ $products->product_unit }} ) <span>{{ $setting->currency }}{{ $products->discount_price * $cart->product_qty }}</span></li>     
                                       @else
                                           <li>{{ $product_Name }} ( {{ $setting->currency }}{{ $products->selling_price}} * {{ $cart->product_qty}}{{ $products->product_unit }} ) <span>{{ $setting->currency }}{{ $products->selling_price * $cart->product_qty }}</span></li>     
                                       @endif
                                      
                                    @endforeach
                                </ul>
                                <div class="checkout__order__list">
                                    <div class="checkout__order__subtotal">SubTotal <span>{{ $setting->currency }}{{ $total_amount }}</span></div>
                                        @if ( Session::has('coupon') )
                                           <div class="checkout__order__coupon">- Coupon ({{ Session::get('coupon')['coupon_name'] }})<a href="{{ route('coupon.remove') }}" class="remove_coupon"><i class="fa fa-times" aria-hidden="true"></i></a>  <span>{{ $setting->currency }}{{ Session::get('coupon')['coupon_discount'] }}</span></div>
                                        @endif
                                    <div class="checkout__order__tax">- Tax (%) <span>{{ $setting->currency }}00</span></div>
                                    <div class="checkout__order__shipping">- Shipping (%) <span>{{ $setting->currency }}00</span></div>
                                </div>

                                @if ( Session::has('coupon') )
                                   <div class="checkout__order__total">Total <span>{{ $setting->currency }}{{ $total_amount - Session::get('coupon')['coupon_discount'] }}</span></div>
                                @else 
                                   <div class="checkout__order__total">Total <span>{{ $setting->currency }}{{ $total_amount }}</span></div>
                                @endif

                                {{-- payment method --}}
                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_type" id="payment_type2" value="Paypal" checked>
                                    <label class="form-check-label" for="payment_type2" style="cursor: pointer;">
                                        Paypal
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_type" id="payment_type3" value="ssl_Commerze">
                                    <label class="form-check-label" for="payment_type3" style="cursor: pointer;">
                                        Ssl_Commerze
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_type" id="payment_type1" value="hand_cash">
                                    <label class="form-check-label" for="payment_type1" style="cursor: pointer;">
                                      Hand Cash
                                    </label>
                                </div>

                                <button type="submit" class="site-btn">PLACE ORDER</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Checkout Section End -->

@endsection