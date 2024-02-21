@extends('frontend.layout.template')

@section('page-title')
   <title>{{ $products->product_name }} | Ecommerce</title>
@endsection

@section('body-content')

        @php
            $color = $products->color;
            $size = $products->size;

            $color_split = preg_split('/(,| ,)/', $color);
            $size_split = preg_split('/(,| ,)/', $size);
        @endphp

        <!-- Breadcrumb Section Begin -->
        <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12 text-center">
                        <div class="breadcrumb__text">
                            <h2>{{ $category->category_name }} Category</h2>
                            <div class="breadcrumb__option">
                                <a href="{{ route('homePage') }}">Home</a>	
                                <span>{{ $products->product_name }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->
    
        <!-- Product Details Section Begin -->
        <section class="product-details spad">
            <div class="container">
                <div class="row">
                    {{-- images show --}}
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__pic">
                            <div class="product__details__pic__item">
                                <img class="product__details__pic__item--large"
                                    src="{{ asset('backend/uploads/products/' . $products->thumbnail ) }}" alt="">
                            </div>

                            <div class="product__details__pic__slider owl-carousel">
                               @foreach ($productImg as $prdtImg)
                                  <img data-imgbigurl="{{ asset('backend/uploads/products/' . $prdtImg->product_image_name ) }}"
                                  src="{{ asset('backend/uploads/products/' . $prdtImg->product_image_name ) }}" alt="">
                               @endforeach

                               <img data-imgbigurl="{{ asset('backend/uploads/products/' . $products->thumbnail ) }}"
                                  src="{{ asset('backend/uploads/products/' . $products->thumbnail ) }}" alt="">

                            </div>
                        </div>
                    </div>

                    {{-- product details --}}
                    <div class="col-lg-6 col-md-6">
                        <div class="product__details__text">
                            <h3>{{ $products->product_name }}</h3>
                            <div class="product__details__rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-half-o"></i>
                                <span>(18 reviews)</span>
                            </div>
                            <div style="color: #6f6f6f">Brand: <span class="brand_div">{{ $brand->brand_name }}</span></div>

                            @if ( $products->discount_price == NULL )
                                <div class="product__details__price">Price: {{ $setting->currency }}{{ $products->selling_price }} 
                                </div>
                            @else
                                <div class="product__details__price">Price: 
                                    <del>
                                        <span >{{ $setting->currency }}{{ $products->selling_price }}</span>
                                    </del> 

                                    <span style="color: #000;">{{ $setting->currency }}{{ $products->discount_price }} </span>
                                </div>
                            @endif

                            <p>{{ strip_tags($products->description) }}</p>

                            <div class="row mb-3">
                                <div class="col-lg-6">
                                    <select class="custom_select_form" name="color">
                                        <option value="" disabled selected>select this color</option>
                                        @foreach ($color_split as $row => $colorSplit)
                                          <option value="{{ $colorSplit }}">{{ $colorSplit }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-lg-6">
                                    <select class="custom_select_form" name="size">
                                        <option value="" disabled selected>select this size</option>
                                        @foreach ($size_split as $sizeSplit)
                                          <option value="{{ $sizeSplit }}">{{ $sizeSplit }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            
                            <div class="product__details__quantity">
                                <div class="quantity">
                                    <div class="pro-qty">
                                        <input type="text" value="1">
                                    </div>
                                </div>
                            </div>
                            <input type="submit" class="primary-btn cart_btn" style="border: none;" value="ADD TO CART" 
                              @if ( $products->quantity_stock == 0 )
                                  disabled
                              @endif
                            />
                            <a href="#" class="heart-icon"><span class="icon_heart_alt"></span></a>

                            <ul>
                                <li><b>Availability</b> 
                                    <span>
                                        @if ( $products->quantity_stock > 0 )
                                          In Stock
                                        @else
                                           Stock Out
                                        @endif
                                    </span>
                                </li>
                                <li><b>Shipping</b> <span>01 day shipping. <samp>Free pickup today</samp></span></li>
                                <li><b>Pickup Point</b> <span>{{ $pickup_point->pickup_point_name }}</span></li>
                                <li><b>Quantity Stock</b> 
                                    <span>
                                        @if ( $products->quantity_stock > 0 )
                                        {{ $products->quantity_stock }} {{$products->product_unit}}
                                        @else
                                           <span class="badge badge-danger">Stock are not available</span>
                                        @endif
                                    </span>
                                </li>
                                <li><b>Product Tags</b> <span>{{ $products->product_tags }}</span></li>
                                <li><b>Share on</b>
                                    <div class="share">
                                        <a href="#"><i class="fa fa-facebook"></i></a>
                                        <a href="#"><i class="fa fa-twitter"></i></a>
                                        <a href="#"><i class="fa fa-instagram"></i></a>
                                        <a href="#"><i class="fa fa-pinterest"></i></a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    {{-- Description information --}}
                    <div class="col-lg-12">
                        <div class="product__details__tab">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" data-toggle="tab" href="#tabs-1" role="tab"
                                        aria-selected="true">Description</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-2" role="tab"
                                        aria-selected="false">Information</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-toggle="tab" href="#tabs-3" role="tab"
                                        aria-selected="false">Reviews <span>(1)</span></a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tabs-1" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Infomation</h6>
                                        <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                            Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus. Vivamus
                                            suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam sit amet quam
                                            vehicula elementum sed sit amet dui. Donec rutrum congue leo eget malesuada.
                                            Vivamus suscipit tortor eget felis porttitor volutpat. Curabitur arcu erat,
                                            accumsan id imperdiet et, porttitor at sem. Praesent sapien massa, convallis a
                                            pellentesque nec, egestas non nisi. Vestibulum ac diam sit amet quam vehicula
                                            elementum sed sit amet dui. Vestibulum ante ipsum primis in faucibus orci luctus
                                            et ultrices posuere cubilia Curae; Donec velit neque, auctor sit amet aliquam
                                            vel, ullamcorper sit amet ligula. Proin eget tortor risus.</p>
                                            <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                            ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                            elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                            porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                            nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.
                                            Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui. Sed
                                            porttitor lectus nibh. Vestibulum ac diam sit amet quam vehicula elementum
                                            sed sit amet dui. Proin eget tortor risus.</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-2" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Infomation</h6>
                                        <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                            Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                            Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                            sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                            eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                            Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                            sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                            diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                            ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                            Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                            Proin eget tortor risus.</p>
                                        <p>Praesent sapien massa, convallis a pellentesque nec, egestas non nisi. Lorem
                                            ipsum dolor sit amet, consectetur adipiscing elit. Mauris blandit aliquet
                                            elit, eget tincidunt nibh pulvinar a. Cras ultricies ligula sed magna dictum
                                            porta. Cras ultricies ligula sed magna dictum porta. Sed porttitor lectus
                                            nibh. Mauris blandit aliquet elit, eget tincidunt nibh pulvinar a.</p>
                                    </div>
                                </div>
                                <div class="tab-pane" id="tabs-3" role="tabpanel">
                                    <div class="product__details__tab__desc">
                                        <h6>Products Infomation</h6>
                                        <p>Vestibulum ac diam sit amet quam vehicula elementum sed sit amet dui.
                                            Pellentesque in ipsum id orci porta dapibus. Proin eget tortor risus.
                                            Vivamus suscipit tortor eget felis porttitor volutpat. Vestibulum ac diam
                                            sit amet quam vehicula elementum sed sit amet dui. Donec rutrum congue leo
                                            eget malesuada. Vivamus suscipit tortor eget felis porttitor volutpat.
                                            Curabitur arcu erat, accumsan id imperdiet et, porttitor at sem. Praesent
                                            sapien massa, convallis a pellentesque nec, egestas non nisi. Vestibulum ac
                                            diam sit amet quam vehicula elementum sed sit amet dui. Vestibulum ante
                                            ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                                            Donec velit neque, auctor sit amet aliquam vel, ullamcorper sit amet ligula.
                                            Proin eget tortor risus.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Product Details Section End -->
    
        <!-- Related Product Section Begin -->
        <section class="related-product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title related__product__title">
                            <h2>Related Product</h2>
                        </div>
                    </div>
                </div>
                
                <div class="row">
                    @foreach ( $related_product as $related_prdt)
                        <div class="col-lg-3 col-md-4 col-sm-6">
                            <div class="product__item">
                                <div class="product__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $related_prdt->thumbnail ) }}">
                                    <ul class="product__item__pic__hover">
                                        <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                        <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                        <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                    </ul>
                                </div>
                                <div class="product__item__text">
                                    <h6><a href="{{ route('productDetails', $related_prdt->slug) }}">{{ $related_prdt->product_name }}</a></h6>
                                    <h5>
                                        @if ( $related_prdt->discount_price == NULL )
                                            {{ $setting->currency }}{{ $related_prdt->selling_price }} 
                                        @else
                                            <del><span>{{ $setting->currency }}{{ $related_prdt->selling_price }}</span></del> 

                                            {{ $setting->currency }}{{ $related_prdt->discount_price }} 
                                        @endif
                                    </h5>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
        <!-- Related Product Section End -->

@endsection