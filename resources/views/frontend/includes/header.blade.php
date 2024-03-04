    @php
        $wishlist_count =  App\Models\Wishlist::where('user_id', Auth::id() )->count();
        $cartlists  =  App\Models\Cart::where('user_id', Auth::id() )->where('order_id', NULL)->get();


        // total item added into cart
        $total_item = 0;
        foreach ($cartlists as $cartlist) {
            $total_item += $cartlist->product_qty;
        }
        
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
    
    <!-- Page Preloder -->
    {{-- <div id="preloder">
        <div class="loader"></div>
    </div> --}}


    <!-- Res Humberger Begin -->
    <div class="humberger__menu__overlay"></div>
    <div class="humberger__menu__wrapper">
        <div class="humberger__menu__logo">
            <a href="{{ route('homePage') }}">
                <img src="{{ asset('frontend/img/logo.png') }}" alt="">
            </a>
        </div>
        <div class="humberger__menu__cart">
            <ul>
                <li><a href="#"><i class="fa fa-heart"></i> <span>1</span></a></li>
                <li>
                    <a href="#"><i class="fa fa-shopping-bag"></i> 
                       <span>
                           @if ( Auth::check() )
                              {{ $wishlist_count }}
                           @else
                              0
                           @endif
                       </span>
                    </a>
                </li>
            </ul>
            <div class="header__cart__price">item: <span>{{ $setting->currency }}150.00</span></div>
        </div>
        <div class="humberger__menu__widget">
            <div class="header__top__right__language">
                <img src="{{ asset('frontend/img/language.png') }}" alt="">
                <div>English</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">Spanis</a></li>
                    <li><a href="#">English</a></li>
                </ul>
            </div>

            <div class="header__top__right__language">
                <div>Currency</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li><a href="#">$ Dollar</a></li>
                    <li><a href="#">৳ BDT</a></li>
                </ul>
            </div>

            <div class="header__top__right__language">
                <i class="fa fa-user"></i>
                <div>Users Account</div>
                <span class="arrow_carrot-down"></span>
                <ul>
                    <li>
                        <a href="{{ route('login') }}">
                            <i class="fa fa-user"></i> Login
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}">
                            <i class="fa fa-user"></i> Register
                        </a>
                    </li>
                </ul>
            </div>
        </div>


        <nav class="humberger__menu__nav mobile-menu">
            <ul>
                <li class="active">
                    <a href="{{ route('homePage') }}">Home</a>
                </li>
                <li>
                    <a href="">Shop</a>
                </li>
                <li>
                    <a href="#">Pages</a>
                    <ul class="header__menu__dropdown">
                        <li><a href="">Shop Details</a></li>
                        <li><a href="">Shoping Cart</a></li>
                        <li><a href="">Check Out</a></li>
                        <li><a href="">Blog Details</a></li>
                    </ul>
                </li>
                <li>
                    <a href="">Blog</a>
                </li>
                <li>
                    <a href="">Contact</a>
                </li>
            </ul>
        </nav>

        <div id="mobile-menu-wrap"></div>
        <div class="header__top__right__social">
            <a href="#"><i class="fa fa-facebook"></i></a>
            <a href="#"><i class="fa fa-twitter"></i></a>
            <a href="#"><i class="fa fa-linkedin"></i></a>
            <a href="#"><i class="fa fa-pinterest-p"></i></a>
        </div>
        <div class="humberger__menu__contact">
            <ul>
                <li><i class="fa fa-envelope"></i> hello@colorlib.com</li>
                <li>Free Shipping for all Order of $99</li>
            </ul>
        </div>
    </div>
    <!-- Res Humberger End -->

    <!-- Header Section Begin -->
    <header class="header">
        <div class="header__top">
            <div class="container">
                <div class="row">
                    <div class="col-lg-5 col-md-5">
                        <div class="header__top__left">
                            <ul>
                                <li><i class="fa fa-envelope"></i>{{ $setting->support_email }}</li>
                                <li>Free Shipping for all Order of $99</li>
                            </ul>
                        </div>
                    </div>

                    <div class="col-lg-7 col-md-7">
                        <div class="header__top__right">
                            <div class="header__top__right__social">
                                <a href="#"><i class="fa fa-facebook"></i></a>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                                <a href="#"><i class="fa fa-linkedin"></i></a>
                                <a href="#"><i class="fa fa-pinterest-p"></i></a>
                            </div>
                            <div class="header__top__right__language">
                                <img src="{{ asset('frontend/img/language.png') }} " alt="">
                                <div>English</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">Spanish</a></li>
                                    <li><a href="#">English</a></li>
                                </ul>
                            </div>

                            <div class="header__top__right__language">
                                <div>Currency</div>
                                <span class="arrow_carrot-down"></span>
                                <ul>
                                    <li><a href="#">$ Dollar</a></li>
                                    <li><a href="#">৳ BDT</a></li>
                                </ul>
                            </div>

                            @if ( !Auth::check() )
                                <div class="header__top__right__language">
                                    <div>Accounts</div>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li><a href="{{ route('login') }}"><i class="fa fa-user"></i> Login</a></li>
                                        <li><a href="{{ route('register') }}"><i class="fa fa-user"></i> Register</a></li>
                                    </ul>
                                </div>
                            @else
                                <div class="header__top__right__language">
                                    <div>{{ Auth::user()->name }}</div>
                                    <span class="arrow_carrot-down"></span>
                                    <ul>
                                        <li><a href="#">Profile</a></li>
                                        <li><a href="#">Setting</a></li>
                                        <li><a href="#">Order List</a></li>
                                        <li>
                                            <form method="POST" action="{{ route('logout') }}">
                                                @csrf
                                                <button type="submit" style="background: transparent; border: none; color: #FFF; ">Logout</button>
                                            </form>
                                        </li>
                                    </ul>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header__logo">
                        <a href="{{ route('homePage') }}"><img src="{{ asset('frontend/img/logo.png') }}" alt=""></a>
                    </div>
                </div>

                <div class="col-lg-6">
                    <nav class="header__menu">
                        <ul>
                            <li class="active"><a href="{{ route('homePage') }}">Home</a></li>
                            <li><a href="{{ route('shopPage') }}">Shop</a></li>
                            <li><a href="#">Pages</a>
                                <ul class="header__menu__dropdown">
                                    <li><a href="./shop-details.html">Shop Details</a></li>
                                    <li><a href="./shoping-cart.html">Shoping Cart</a></li>
                                    <li><a href="./checkout.html">Check Out</a></li>
                                    <li><a href="./blog-details.html">Blog Details</a></li>
                                </ul>
                            </li>
                            <li><a href="./blog.html">Blog</a></li>
                            <li><a href="./contact.html">Contact</a></li>
                        </ul>
                    </nav>
                </div>

                <div class="col-lg-3">
                    <div class="header__cart">
                        <ul>
                            <li>
                                <a href="{{ route('wishlist') }}"><i class="fa fa-heart"></i> 
                                    <span>
                                        @if ( Auth::check() )
                                           {{ $wishlist_count }}
                                        @else
                                           0
                                        @endif
                                    </span>
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('cart.manage') }}"><i class="fa fa-shopping-bag"></i> 
                                    <span>
                                        @if ( Auth::check() )
                                           {{ $total_item }}
                                        @else
                                           0
                                        @endif
                                    </span>
                                </a>
                            </li>
                        </ul>
                        <div class="header__cart__price">item: <span>{{ $setting->currency }}{{ $total_amount }}</span></div>
                    </div>
                </div>
            </div>
            
            <div class="humberger__open">
                <i class="fa fa-bars"></i>
            </div>
        </div>
    </header>
    <!-- Header Section End -->