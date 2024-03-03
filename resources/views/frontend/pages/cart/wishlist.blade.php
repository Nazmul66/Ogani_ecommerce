@extends('frontend.layout.template')

@section('page-title')
   <title>Wishlist | Ecommerce</title>
@endsection

@section('body-content')

    <!-- Breadcrumb Section Begin -->
    <section class="breadcrumb-section set-bg" data-setbg="{{ asset('frontend/img/breadcrumb.jpg') }}">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 text-center">
                    <div class="breadcrumb__text">
                        <h2>Wishlist</h2>
                        <div class="breadcrumb__option">
                            <a href="{{ route('homePage') }}">Home</a>
                            <span>Wishlist</span>
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

                      @if ( $wishlists->count() === 0 )
                        <div class="alert alert-danger text-center" role="alert">
                            There is no wishlists data available right now!
                        </div>

                      @else
                        <table>
                            <thead>
                                <tr>
                                    <th class="shoping__product">Products</th>
                                    <th>Date</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($wishlists as $wishlist)

                                @php
                                    $products  =  App\Models\Product::where('id', $wishlist->product_id)->get();
                                @endphp

                                    @foreach ($products as $product)
                                    <tr>
                                        <td class="shoping__cart__item">
                                            <img src="{{ asset('backend/uploads/products/' . $product->thumbnail) }}" alt="" style="width: 125px;">
                                            <h5>{{ $product->product_name }}</h5>
                                        </td>
                                        <td>
                                           <span style="color: #000; font-weight: 600;">{{ $wishlist->date }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('productDetails', $product->slug ) }}">
                                                <button type="button" class="btn btn-info">Add To Cart</button>
                                            </a>
                                            <a href="{{ route('wishlist.destroy', $wishlist->id) }}">
                                                <i class="fa fa-times customs-icon" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @endforeach
                                @endforeach
                            </tbody>
                        </table>
                      @endif
                    </div>

                    {{-- Home page --}}
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="shoping__cart__btns">
                                <a href="{{ route('clear.wishlist') }}" class="primary-btn cart-btn">Clear Wishlist</a>
                                <a href="{{ route('homePage') }}" class="primary-btn cart-btn cart-btn-right"><span class="icon_loading"></span>
                                    Back To Home</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Shoping Cart Section End -->

@endsection