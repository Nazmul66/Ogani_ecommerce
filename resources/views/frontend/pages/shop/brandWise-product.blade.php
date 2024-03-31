@extends('frontend.layout.template')

@section('page-title')
   <title>Shop Page - {{ $brand->brand_name }} | Ecommerce</title>
@endsection

@section('body-content')

    @include('frontend.includes.category-nav')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Organi Shop</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('homePage') }}">Home</a>
                            <span>{{ $brand->brand_name }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Brand Logo Section Begin -->
    <section class="brand_logo">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="owl-carousel owl-theme owls_border">
                        @foreach ($brands as $brand)
                            <div class="item">
                                <a href="{{ route('brandwise.product', $brand->id) }}" title="{{ $brand->brand_slug }}">
                                    <img src="{{ asset('backend/uploads/brand/' . $brand->brand_logo) }}" alt="{{ $brand->brand_slug }}" style="width: 75px;">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Brand Logo Section End -->

    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">
                {{-- shop sidebar --}}
                <div class="col-lg-3 col-md-5">
                    <div class="sidebar">
                        <div class="sidebar__item">
                            <h4>Category</h4>
                            <ul class="cat_list">
                                <li>
                                    @foreach ($Categories as $Category)
                                        <a href="{{ route('categoryWise.product', $Category->id) }}">{{ $Category->category_name }}</a>
                                    @endforeach
                                </li>
                            </ul>
                        </div>

                        {{-- price range bar --}}
                        <div class="sidebar__item">
                            <h4>Price</h4>
                            <div class="price-range-wrap">
                                <div class="price-range ui-slider ui-corner-all ui-slider-horizontal ui-widget ui-widget-content"
                                    data-min="10" data-max="540">
                                    <div class="ui-slider-range ui-corner-all ui-widget-header"></div>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                    <span tabindex="0" class="ui-slider-handle ui-corner-all ui-state-default"></span>
                                </div>
                                <div class="range-slider">
                                    <div class="price-input">
                                        <input type="text" id="minamount">
                                        <input type="text" id="maxamount">
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- color items shows --}}
                        <div class="sidebar__item sidebar__item__color--option">
                            <h4>Colors</h4>
                            <div class="sidebar__item__color sidebar__item__color--white">
                                <label for="white">
                                    White
                                    <input type="radio" id="white">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--gray">
                                <label for="gray">
                                    Gray
                                    <input type="radio" id="gray">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--red">
                                <label for="red">
                                    Red
                                    <input type="radio" id="red">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--black">
                                <label for="black">
                                    Black
                                    <input type="radio" id="black">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--blue">
                                <label for="blue">
                                    Blue
                                    <input type="radio" id="blue">
                                </label>
                            </div>
                            <div class="sidebar__item__color sidebar__item__color--green">
                                <label for="green">
                                    Green
                                    <input type="radio" id="green">
                                </label>
                            </div>
                        </div>

                        {{-- products size shows --}}
                        <div class="sidebar__item">
                            <h4>Popular Size</h4>
                            <div class="sidebar__item__size">
                                <label for="large">
                                    Large
                                    <input type="radio" id="large">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="medium">
                                    Medium
                                    <input type="radio" id="medium">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="small">
                                    Small
                                    <input type="radio" id="small">
                                </label>
                            </div>
                            <div class="sidebar__item__size">
                                <label for="tiny">
                                    Tiny
                                    <input type="radio" id="tiny">
                                </label>
                            </div>
                        </div>

                        {{-- latest product show --}}
                        <div class="sidebar__item">
                            <div class="latest-product__text">
                                <h4>Latest Products</h4>
                                <div class="latest-product__slider owl-carousel">
                                    <div class="latest-prdouct__slider__item">
                                    @foreach ( App\Models\Product::where('discount_price', NULL)->orderBy('id', 'desc')->limit(3)->get() as $product)
                                            <a href="{{ route('productDetails', $product->slug ) }}" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="{{ asset('backend/uploads/products/' . $product->thumbnail) }}" alt="">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{ $product->product_name }}</h6>
                                                    <h5>
                                                        @if ( $product->discount_price )
                                                            <del>
                                                                <span>{{ $setting->currency }}{{ $product->selling_price }}</span>/-
                                                            </del> 
                                                            {{ $setting->currency }}{{ $product->discount_price }}/-
                                                        @else
                                                            {{ $setting->currency }}{{ $product->selling_price }}/-
                                                        @endif
                                                    </h5>
                                                </div>
                                            </a>
                                    @endforeach
                                    </div>

                                    <div class="latest-prdouct__slider__item">
                                        @foreach ( App\Models\Product::where('discount_price', NULL)->orderBy('id', 'desc')->skip(3)->limit(3)->get() as $product)
                                            <a href="{{ route('productDetails', $product->slug ) }}" class="latest-product__item">
                                                <div class="latest-product__item__pic">
                                                    <img src="{{ asset('backend/uploads/products/' . $product->thumbnail) }}" alt="">
                                                </div>
                                                <div class="latest-product__item__text">
                                                    <h6>{{ $product->product_name }}</h6>
                                                    <h5>
                                                        @if ( $product->discount_price )
                                                            <del>
                                                                <span>{{ $setting->currency }}{{ $product->selling_price }}</span>/-
                                                            </del> 
                                                            {{ $setting->currency }}{{ $product->discount_price }}/-
                                                        @else
                                                            {{ $setting->currency }}{{ $product->selling_price }}/-
                                                        @endif
                                                    </h5>
                                                </div>
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- shop mian body part start --}}
                <div class="col-lg-9 col-md-7">
                    <div class="product__discount">
                        <div class="section-title product__discount__title">
                            <h2>Sale Off</h2>
                        </div>

                        <div class="row">
                            <div class="product__discount__slider owl-carousel">

                                @foreach ($productSales as $productSale)
                                    @php
                                        $discount_compare = $productSale->selling_price - $productSale->discount_price;
                                        $discount_rate = ( $discount_compare / $productSale->selling_price ) * 100;
                                    @endphp

                                    <div class="col-lg-4">
                                        <div class="product__discount__item">
                                            <div class="product__discount__item__pic set-bg"
                                                data-setbg="{{ asset('backend/uploads/products/' . $productSale->thumbnail) }}">
                                                <div class="product__discount__percent">
                                                    -{{ round($discount_rate, 1) }}%
                                                </div>
                                                <ul class="product__item__pic__hover">
                                                    <li><a href="#"><i class="fa fa-heart"></i></a></li>
                                                    <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                                    <li>
                                                        <form method="POST" action="{{ route('cart.store') }}">
                                                            @csrf
                                                            <input type="hidden" name="prdct_id" value="{{ $productSale->id }}">
                                                           <button type="submit" style="border: none !important;
                                                           background: transparent !important;"> 
                                                              <a><i class="fa fa-shopping-cart"></i></a>
                                                           </button>
                                                        </form>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="product__discount__item__text">
                                                <span>
                                                    @foreach (App\Models\Category::where('id', $productSale->category_id)->get() as $row)
                                                      {{ $row->category_name  }} 
                                                    @endforeach
                                                </span>
                                                <h5><a href="{{ route('productDetails', $productSale->slug ) }}">{{ $productSale->product_name }}</a></h5>
                                                <div class="product__item__price">
                                                    {{ $setting->currency }}{{ $productSale->discount_price }} <span>{{ $setting->currency }}{{ $productSale->selling_price }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>


                    {{-- filter item start --}}
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-4 col-md-5">
                                <div class="d-flex">
                                    <span>Sort By</span>
                                    <select class="form-control">
                                        <option value="higest" selected>Higest Rated</option>
                                        <option value="lowest">Lowest Rated</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-4">
                                <div class="filter__found">
                                    <h6><span>{{ $products->count() }}</span> Products found</h6>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-3">
                                <div class="filter__option">
                                    <span class="icon_grid-2x2"></span>
                                    <span class="icon_ul"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- filter item end --}}

                    {{-- all prodcuts show --}}
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-4 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $product->thumbnail) }}">
                                        <ul class="product__item__pic__hover">
                                            <li><a href="{{ route('add.wishlist', $product->id) }}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li>
                                                <form method="POST" action="{{ route('cart.store') }}">
                                                    @csrf
                                                    <input type="hidden" name="prdct_id" value="{{ $product->id }}">
                                                   <button type="submit" style="border: none !important;
                                                   background: transparent !important;"> 
                                                      <a><i class="fa fa-shopping-cart"></i></a>
                                                   </button>
                                                </form>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="product__item__text">
                                        <span style="color: #b2b2b2;" class="mb-1 d-block">
                                            @foreach (App\Models\Category::where('id', $product->category_id)->get() as $row)
                                               {{ $row->category_name  }} 
                                            @endforeach
                                        </span>
                                        <h6><a href="{{ route('productDetails', $product->slug ) }}">{{ $product->product_name }}</a></h6>
                                        <h5>
                                            @if ( $product->discount_price )
                                                <del>
                                                    <span>{{ $setting->currency }}{{ $product->selling_price }}</span>/-
                                                </del> 
                                                {{ $setting->currency }}{{ $product->discount_price }}/-
                                            @else
                                                {{ $setting->currency }}{{ $product->selling_price }}/-
                                            @endif
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach                    
                    </div>

                    <div class="product__pagination">
                        <a href="#">1</a>
                        <a href="#">2</a>
                        <a href="#">3</a>
                        <a href="#"><i class="fa fa-long-arrow-right"></i></a>
                    </div>
                </div>
                {{-- shop mian body part end --}}
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Random Product Section Begin -->
    <section class="">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="section-title">
                        <h2>Product For You</h2>
                    </div>
                    <div class="row">
                        <div class="categories__slider owl-carousel">
                            
                            @foreach ($random_products as $random_product)

                            <div class="col-lg-3 col-md-4 col-sm-6 mix vegetables fastfood">
                                <div class="featured__item">
                                    <div class="featured__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $random_product->thumbnail) }}">
                                        <ul class="featured__item__pic__hover">
                                            <li><a href="{{ route('add.wishlist', $random_product->id) }}"><i class="fa fa-heart"></i></a></li>
                                            <li><a href="#"><i class="fa fa-retweet"></i></a></li>
                                            <li><a href="#"><i class="fa fa-shopping-cart"></i></a></li>
                                        </ul>
                                    </div>
                                    <div class="featured__item__text">
                                        <h6><a href="{{ route('productDetails', $random_product->slug ) }}">{{ $random_product->product_name }}</a></h6>
                                        <h5>
                                            @if ( $random_product->discount_price )
                                                <del>
                                                    <span>{{ $setting->currency }}{{ $random_product->selling_price }}</span>/-
                                                </del> 
                                                {{ $setting->currency }}{{ $random_product->discount_price }}/-
                                            @else
                                                {{ $setting->currency }}{{ $random_product->selling_price }}/-
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
    <!-- Random Product Section End -->

@endsection

@section('scripts')
    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 10,
            nav: false,
            autoplay: true,
            autoplayTimeout: 2500,
            autoplayHoverPause: true,
            responsive:{
                320: {
                items: 4,
                },
                480: {
                    items: 5,
                },
                768: {
                    items: 7,
                },
                992: {
                    items: 10,
                }
            }
        })
    </script>
@endsection

