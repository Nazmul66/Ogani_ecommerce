@extends('frontend.layout.template')

@section('page-title')
   <title>Shop Page - Campaign Details | Ecommerce</title>
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
                            <span>Campaign Details</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Product Section Begin -->
    <section class="product spad">
        <div class="container">
            <div class="row">

                {{-- shop mian body part start --}}
                <div class="col-lg-12">

                    {{-- filter item start --}}
                    <div class="filter__item">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="total_count">
                                    <h6><span>{{ $products->count() }}</span> Products found</h6>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="d-flex align-items-center justify-content-end">
                                    <span>Sort By</span>
                                    <select class="filtering">
                                        <option value="higest" selected>Higest Rated</option>
                                        <option value="lowest">Lowest Rated</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- filter item end --}}

                    {{-- all prodcuts show --}}
                    <div class="row">
                        @foreach ($products as $product)
                            <div class="col-lg-3 col-md-6 col-sm-6">
                                <div class="product__item">
                                    <div class="product__item__pic set-bg" data-setbg="{{ asset('backend/uploads/products/' . $product->thumbnail) }}">
                                        <ul class="product__item__pic__hover">
                                            <li>
                                                <a href="{{ route('add.wishlist', $product->id) }}"><i class="fa fa-heart"></i></a>
                                            </li>
                                            <li>
                                                <a href="#"><i class="fa fa-retweet"></i></a>
                                            </li>
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
                                            @foreach (App\Models\Category::where('id', $product->category_id )->get() as $row)
                                               {{ $row->category_name  }} 
                                            @endforeach
                                        </span>
                                        <h6>
                                            <a href="{{ route('campaign.product.details', $product->slug ) }}">{{ $product->product_name }}</a>
                                        </h6>
                                        <h5>{{ $setting->currency }}{{ $product->price }}</h5>
                                    </div>
                                </div>
                            </div>
                        @endforeach                    
                    </div>
                </div>
                {{-- shop mian body part end --}}
            </div>
        </div>
    </section>
    <!-- Product Section End -->

@endsection



