
@php
    $color = $products->color;
    $size = $products->size;

    $color_split = preg_split('/(,| ,)/', $color);
    $size_split = preg_split('/(,| ,)/', $size);

    $five_star   =  App\Models\Review::where('rating', 5)->where('product_id', $products->id)->get()->count();
    $four_star   =  App\Models\Review::where('rating', 4)->where('product_id', $products->id)->get()->count();
    $three_star  =  App\Models\Review::where('rating', 3)->where('product_id', $products->id)->get()->count();
    $two_star    =  App\Models\Review::where('rating', 2)->where('product_id', $products->id)->get()->count();
    $one_star    =  App\Models\Review::where('rating', 1)->where('product_id', $products->id)->get()->count();

    $existingWishlist = App\Models\Wishlist::where('user_id', Auth::id())->where('product_id', $products->id)->first();

@endphp

@extends('frontend.layout.template')

@section('page-title')
   <title>{{ $products->product_name }} | Ecommerce</title>
@endsection

@section('body-content')

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
                            <div style="color: #6f6f6f;" class="mb-2">Brand: <span class="brand_div">{{ $brand->brand_name }}</span></div>
                            <div style="color: #6f6f6f">Product Views: {{ $products->product_view }} <i class="fa fa-eye" aria-hidden="true"></i></div>

                            @if ( $products->discount_price == NULL )
                                <div class="product__details__price">Price: {{ $setting->currency }}{{ $products->selling_price }}/-
                                </div>
                            @else
                                <div class="product__details__price">Price: 
                                    <del>
                                        <span>{{ $setting->currency }}{{ $products->selling_price }}</span>/-
                                    </del> 

                                    <span style="color: #000;">{{ $setting->currency }}{{ $products->discount_price }}</span>/-
                                </div>
                            @endif

                            <p>{{ strip_tags($products->description) }}</p>

                            <form method="POST" action="">
                                
                                @csrf

                                <div class="row mb-3">
                                    @if ( !is_null( $products->color) )
                                        <div class="col-lg-6">
                                            <select class="custom_select_form" name="color">
                                                <option value="" disabled selected>select this color</option>
                                                @foreach ($color_split as $row => $colorSplit)
                                                <option value="{{ $colorSplit }}">{{ $colorSplit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                    
                                    @if ( !is_null( $products->size) )
                                        <div class="col-lg-6">
                                            <select class="custom_select_form" name="size">
                                                <option value="" disabled selected>select this size</option>
                                                @foreach ($size_split as $sizeSplit)
                                                <option value="{{ $sizeSplit }}">{{ $sizeSplit }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    @endif
                                </div>
                                
                                <div class="product__details__quantity">
                                    <div class="quantity">
                                        <div class="pro-qty">
                                            <input type="text" name="quantity" value="1">
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="submit" class="primary-btn cart_btn" style="border: none;" value="ADD TO CART" 
                                @if ( $products->quantity_stock == 0 ) disabled @endif/>

                                <a href="{{ route('add.wishlist', $products->id) }}" class="heart-icon @if( $existingWishlist ) text-success @endif"><span class="icon_heart_alt"></span></a>
                            </form>

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
                                        aria-selected="false">Rating & Reviews</a>
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
                                    <div class="product__details__tab__desc border">
                                        <div class="alert alert-warning" role="alert">
                                            Ratings & Reviews of {{ $products->product_name }}
                                        </div>

                                        <div class="row p-3">
                                            <div class="col-lg-4 mb-3">
                                               <span>Average Review of {{ $products->product_name }} variation silver:</span>
                                               <div class="star_ratings">
                                                   <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                   <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                   <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                   <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                   <i class="fa fa-star" aria-hidden="true"></i>
                                               </div>
                                            </div>

                                            <div class="col-lg-3 mb-3">
                                               <span>Total Review of this product: </span>
                                               <div class="five_star">
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <span style="font-weight: 600; margin-left: 8px">Total {{ $five_star }}</span>
                                               </div>

                                                <div class="four_star">
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <span style="font-weight: 600; margin-left: 8px">Total {{ $four_star }}</span>
                                               </div>

                                               <div class="three_star">
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <span style="font-weight: 600; margin-left: 8px">Total {{ $three_star }}</span>
                                                </div>

                                                <div class="two_star">
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <span style="font-weight: 600; margin-left: 8px">Total {{ $two_star }}</span>
                                                </div>

                                                <div class="one_star">
                                                    <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <i class="fa fa-star" aria-hidden="true"></i>
                                                    <span style="font-weight: 600; margin-left: 8px">Total {{ $one_star }}</span>
                                                </div>
                                            </div>

                                            {{-- Product Review form submit --}}
                                            <div class="col-lg-5">
                                                <form method="POST" action="{{ route('store.review') }}">

                                                    @csrf

                                                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                                                    <div class="mb-3">
                                                        <label class="form-label">Write your Reviews</label>
                                                        <textarea class="form-control" name="review" rows="3"></textarea>
                                                    </div>
    
                                                    <div class="d-flex align-items-center">
                                                        <span style="margin-right: 20px;">Select Review star</span>
                                                        <select class="form-select" aria-label="Default select example" name="rating_star">
                                                            <option selected>Select your Review</option>
                                                            <option value="1">1 star</option>
                                                            <option value="2">2 star</option>
                                                            <option value="3">3 star</option>
                                                            <option value="4">4 star</option>
                                                            <option value="5">5 star</option>
                                                        </select>
                                                    </div>
    
                                                    @if ( Auth::check() )
                                                        <button type="submit" class="btn btn-info mt-3">
                                                            <i class="fa fa-star white_star" aria-hidden="true"></i>
                                                            Submit Review
                                                        </button>
                                                    @endif
                                                </form>
                                            </div>
                                        </div>

                                        {{-- All customer reviews show --}}
                                        <div class="p-3">
                                            <div class="review_container">
                                                <div class="mb-3 border-bottom pb-3"><strong>All review of {{ $products->product_name }}</strong></div>

                                                <div class="row">
                                                    @foreach ($review_products as $review_prdt)
                                                        <div class="col-lg-6">
                                                            <div class="card">
                                                                <div class="card-body">
                                                                    <div class="alert alert-secondary" role="alert">
                                                                        @foreach ($users as $user)
                                                                            @if( $user->id == $review_prdt->user_id ) 
                                                                                {{ $user->name }} - ( {{ date('d F, Y') }} )
                                                                            @endif
                                                                        @endforeach
                                                                    </div>
                                                                    <p>{{ $review_prdt->review }}</p>

                                                                    @if ( $review_prdt->rating == 5 )
                                                                        <div class="one_star">
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <span style="font-weight: 600; margin-left: 8px">( {{ $review_prdt->rating }} star )</span>
                                                                        </div>
                                                                    @elseif ( $review_prdt->rating == 4 )
                                                                        <div class="one_star">
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <span style="font-weight: 600; margin-left: 8px">( {{ $review_prdt->rating }} star )</span>
                                                                        </div>
                                                                    @elseif ( $review_prdt->rating == 3 )
                                                                        <div class="one_star">
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <span style="font-weight: 600; margin-left: 8px">( {{ $review_prdt->rating }} star )</span>
                                                                        </div>
                                                                    @elseif ( $review_prdt->rating == 2 )
                                                                        <div class="one_star">
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <span style="font-weight: 600; margin-left: 8px">( {{ $review_prdt->rating }} star )</span>
                                                                        </div>
                                                                    @elseif ( $review_prdt->rating == 1 )
                                                                        <div class="one_star">
                                                                            <i class="fa fa-star orang_star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <i class="fa fa-star" aria-hidden="true"></i>
                                                                            <span style="font-weight: 600; margin-left: 8px">( {{ $review_prdt->rating }} star )</span>
                                                                            
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                        
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