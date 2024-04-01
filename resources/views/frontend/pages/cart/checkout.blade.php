@php
    $cartlists  =  App\Models\Cart::where('user_id', Auth::id() )->where('order_id', NULL)->get();

    //total amount
    $subTotal = 0;
    foreach ($cartlists as $cartlist) {
        $products   =  App\Models\Product::where('id', $cartlist->product_id)->get();

        foreach ($products as $product) {
            if( $product->discount_price ){
                $subTotal += $cartlist->product_qty * $product->discount_price;
            }
            else{
                $subTotal += $cartlist->product_qty * $product->selling_price;
            }
        }
    }

    $tax = ( $subTotal * 5 ) / 100;
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
                <form method="post" action="{{ route('make.payment') }}">

                    @csrf

                    <input type="hidden" name="subtotal" value="{{ $subTotal }}">
                    <input type="hidden" name="tax" value="{{ $tax }}">
                    <input type="hidden" name="total" 
                    @if ( Session::has('coupon') )
                     value="{{ $subTotal - Session::get('coupon')['coupon_discount'] + $tax }}"
                    @else
                     value="{{ $subTotal + $tax }}"
                    @endif
                    >

                    <div class="row">
                        <div class="col-lg-8 col-md-6">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="checkout__input">
                                        <p>Full Name<span>*</span></p>
                                        <input type="text" name="c_name"
                                         @if ( !is_null($users->name) )
                                            value="{{ $users->name }}"
                                         @else
                                            value="{{ old('c_name') }}"
                                         @endif
                                        placeholder="Enter your name" autocomplete="off">
                                    </div>
                                </div>
                            </div>

                            <div class="checkout__input">
                                <p>Email<span>*</span></p>
                                <input type="email" name="c_email"  @if ($users->email) value="{{ $users->email }}" @endif readonly autocomplete="off">
                            </div>
                            
                            <div class="checkout__input">
                                <p>Address<span>*</span></p>
                                <input type="text" name="c_address" 
                                    @if ( !is_null($users->address_Line1) )
                                       value="{{ $users->address_Line1 }}"
                                    @else
                                       value="{{ old('c_address') }}"
                                    @endif
                                autocomplete="off" placeholder="Street Address" class="checkout__input__add">
                                <input type="text" name="c_address_optional"
                                    @if ( !is_null($users->address_Line2) )
                                       value="{{ $users->address_Line2 }}"
                                    @else
                                       value="{{ old('c_address_optional') }}"
                                    @endif
                                autocomplete="off" placeholder="Apartment, suite, unite ect (optinal)">
                            </div>

                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="checkout__input">
                                        <p>Phone<span>*</span></p>
                                        <input type="text" name="c_phone" 
                                            @if ( !is_null($users->phone) )
                                               value="{{ $users->phone }}"
                                            @else
                                                value="{{ old('c_phone') }}"
                                            @endif
                                        autocomplete="off">
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
                                <p>Country<span>*</span></p>
                                <select class="form-control" name="c_division">
                                    <option value="" selected disabled>Please Select the Country</option>
                                      @foreach ($countries as $country)
                                        <option value="{{ $country->id }}" @if( $country->id == $users->country_id ) selected @endif>{{ $country->name }}</option>
                                      @endforeach
                                </select>
                            </div>

                            <div class="checkout__input">
                                <p>Division<span>*</span></p>
                                <select class="form-control" name="c_division">
                                    <option value="" selected disabled>Please Select the Division</option>
                                      @foreach ($divisions as $division)
                                        <option value="{{ $division->id }}" @if( $division->id == $users->division_id ) selected @endif>{{ $division->division_name }}</option>
                                      @endforeach
                                </select>
                            </div>

                            <div class="checkout__input">
                                <p>District<span>*</span></p>
                                <select class="form-control" name="c_district">
                                    <option value="" selected disabled>Please Select the District</option>
                                      @foreach ($districts as $district)
                                        <option value="{{ $district->id }}" @if( $district->id == $users->district_id ) selected @endif>{{ $district->district_name }}</option>
                                      @endforeach
                                </select>
                            </div>
                            
                            <div class="checkout__input">
                                <p>Postcode / ZIP<span>*</span></p>
                                <input type="text" name="c_zipCode" 
                                         @if ( !is_null($users->zipCode) )
                                            value="{{ $users->zipCode }}"
                                        @else
                                            value="{{ old('c_zipCode') }}"
                                        @endif
                                autocomplete="off">
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
                                    <div class="checkout__order__subtotal">SubTotal <span>{{ $setting->currency }}{{ $subTotal }}</span></div>
                                        @if ( Session::has('coupon') )
                                           <div class="checkout__order__coupon">- Coupon ({{ Session::get('coupon')['coupon_name'] }})<a href="{{ route('coupon.remove') }}" class="remove_coupon"><i class="fa fa-times" aria-hidden="true"></i></a>  <span>{{ $setting->currency }}{{ Session::get('coupon')['coupon_discount'] }}</span></div>
                                        @endif
                                    <div class="checkout__order__tax">+ Tax (5%) <span>{{ $setting->currency }} {{ $tax }}</span></div>
                                    <div class="checkout__order__shipping">+ Shipping (%) <span>{{ $setting->currency }}00</span></div>
                                </div>

                                @if ( Session::has('coupon') )
                                   <div class="checkout__order__total">Total <span>{{ $setting->currency }}{{ $subTotal - Session::get('coupon')['coupon_discount'] + $tax }}</span></div>
                                @else 
                                   <div class="checkout__order__total">Total <span>{{ $setting->currency }}{{ $subTotal + $tax }}</span></div>
                                @endif

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_type" id="payment_type1" value="ssl_Commerze" checked>
                                    <label class="form-check-label" for="payment_type1" style="cursor: pointer;">
                                        Ssl_Commerze
                                    </label>
                                </div>

                                <div class="form-check mb-2">
                                    <input class="form-check-input" type="radio" name="payment_type" id="payment_type2" value="hand_cash">
                                    <label class="form-check-label" for="payment_type2" style="cursor: pointer;">
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



@section('scripts')

<script>
    (function (window, document) {
        var loader = function () {
            var script = document.createElement("script"), tag = document.getElementsByTagName("script")[0];
            script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36).substring(7);
            tag.parentNode.insertBefore(script, tag);
        };
    
        window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload", loader);
    })(window, document);

    // hide the shipping cost
    let ssl_commerz  = document.getElementById("payment_type1");
    let hand_cash    = document.getElementById("payment_type2");
    let shippment    = document.querySelector(".checkout__order__shipping");

    hand_cash.addEventListener("click", function(){
        shippment.style.display = "none";
    })

    ssl_commerz.addEventListener("click", function(){
        shippment.style.display = "block";
    })
</script>

@endsection