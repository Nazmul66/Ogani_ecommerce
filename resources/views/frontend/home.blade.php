@extends('frontend.layout.template')

@section('page-title')
   <title>Ogani | Template</title>
@endsection

@section('body-content')

        @include('frontend.includes.category-nav')

        <!-- Banner Section Begin -->
        <section class="banner_section">
            <div class="container">
                <div class="row">
                    <div class="col-lg-9 offset-lg-3">
                        <div class="hero__item set-bg" data-setbg="{{ asset('frontend/img/hero/banner.jpg') }}">
                            <div class="hero__text">
                                <span>FRUIT FRESH</span>
                                <h2>Vegetable <br />{{ $setting->currency }} 100% Organic</h2>
                                <p>Free Pickup and Delivery Available</p>
                                <a href="{{ route('productDetails', $product->slug) }}" class="primary-btn">SHOP NOW</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Banner Section End -->
      
        <!-- Categories Section Begin -->
        <section class="categories">
            <div class="container">
                <div class="row">
                    <div class="categories__slider owl-carousel">
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('frontend/img/categories/cat-1.jpg') }}">
                                <h5><a href="#">Fresh Fruit</a></h5>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('frontend/img/categories/cat-2.jpg') }}">
                                <h5><a href="#">Dried Fruit</a></h5>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('frontend/img/categories/cat-3.jpg') }}">
                                <h5><a href="#">Vegetables</a></h5>
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('frontend/img/categories/cat-4.jpg') }}">
                                <h5><a href="#">drink fruits</a></h5>
                            </div>
                        </div>
                        
                        <div class="col-lg-3">
                            <div class="categories__item set-bg" data-setbg="{{ asset('frontend/img/categories/cat-5.jpg') }}">
                                <h5><a href="#">drink fruits</a></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Categories Section End -->
    

        <!-- Featured Section Begin -->
        <section class="featured spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Featured Product</h2>
                        </div>
                        <div class="row">
                            <div class="categories__slider owl-carousel">
                               
                              @foreach ($featured_product as $featured_prdt)

                                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $featured_prdt->thumbnail) }}">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="{{ route('add.wishlist', $featured_prdt->id) }}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="{{ route('productDetails', $featured_prdt->slug ) }}">{{ $featured_prdt->product_name }}</a></h6>
                                            <h5>
                                                @if ( $featured_prdt->discount_price )
                                                    <del>
                                                        <span>{{ $setting->currency }}{{ $featured_prdt->selling_price }}</span>
                                                    </del> 
                                                    {{ $setting->currency }}{{ $featured_prdt->discount_price }}
                                                @else
                                                    {{ $setting->currency }}{{ $featured_prdt->selling_price }}
                                                @endif
                                                
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                              @endforeach  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Featured Section End -->
    
        <!-- Banner Begin -->
        <div class="banner">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="{{ asset('frontend/img/banner/banner-1.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                        <div class="banner__pic">
                            <img src="{{ asset('frontend/img/banner/banner-2.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Banner End -->
    
        <!-- Most Popular Section Begin -->
        <section class="most_popular">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Most Popular Product</h2>
                        </div>
                        <div class="row">
                            <div class="categories__slider owl-carousel">
                               
                              @foreach ($popular_product as $popular_prdt)

                                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $popular_prdt->thumbnail) }}">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="{{ route('add.wishlist', $popular_prdt->id) }}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="{{ route('productDetails', $popular_prdt->slug ) }}">{{ $popular_prdt->product_name }}</a></h6>
                                            <h5>
                                                @if ( $popular_prdt->discount_price )
                                                    <del>
                                                        <span>{{ $setting->currency }}{{ $popular_prdt->selling_price }}</span>/-
                                                    </del> 
                                                    {{ $setting->currency }}{{ $popular_prdt->discount_price }}/-
                                                @else
                                                    {{ $setting->currency }}{{ $popular_prdt->selling_price }}/-
                                                @endif
                                                
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                              @endforeach  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Most Popular Section End -->

        <!-- Trendy Product Section Begin -->
        <section class="trendy_product">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title">
                            <h2>Trendy Product</h2>
                        </div>
                        <div class="row">
                            <div class="categories__slider owl-carousel">
                                
                                @foreach ($trendy_product as $trendy_prdt)

                                <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                                    <div class="featured__item">
                                        <div class="featured__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $trendy_prdt->thumbnail) }}">
                                            <ul class="featured__item__pic__hover">
                                                <li><a href="{{ route('add.wishlist', $trendy_prdt->id) }}"><i class="fa fa-heart"></i></a></li>
                                                <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                            </ul>
                                        </div>
                                        <div class="featured__item__text">
                                            <h6><a href="{{ route('productDetails', $trendy_prdt->slug ) }}">{{ $trendy_prdt->product_name }}</a></h6>
                                            <h5>
                                                @if ( $trendy_prdt->discount_price )
                                                    <del>
                                                        <span>{{ $setting->currency }}{{ $trendy_prdt->selling_price }}</span>/-
                                                    </del> 
                                                    {{ $setting->currency }}{{ $trendy_prdt->discount_price }}/-
                                                @else
                                                    {{ $setting->currency }}{{ $trendy_prdt->selling_price }}/-
                                                @endif
                                                
                                            </h5>
                                        </div>
                                    </div>
                                </div>
                                @endforeach  

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Trendy Product Section End -->
    
        <!-- Blog Section Begin -->
        <section class="from-blog spad">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="section-title from-blog__title">
                            <h2>From The Blog</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('frontend/img/blog/blog-1.jpg') }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="#">Cooking tips make cooking simple</a></h5>
                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('frontend/img/blog/blog-2.jpg') }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="#">6 ways to prepare breakfast for 30</a></h5>
                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="blog__item">
                            <div class="blog__item__pic">
                                <img src="{{ asset('frontend/img/blog/blog-3.jpg') }}" alt="">
                            </div>
                            <div class="blog__item__text">
                                <ul>
                                    <li><i class="fa fa-calendar-o"></i> May 4,2019</li>
                                    <li><i class="fa fa-comment-o"></i> 5</li>
                                </ul>
                                <h5><a href="#">Visit the clean farm in the US</a></h5>
                                <p>Sed quia non numquam modi tempora indunt ut labore et dolore magnam aliquam quaerat </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Blog Section End -->

@endsection


@section('scripts')
    
@endsection