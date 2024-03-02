        <!-- Category nav Section Begin -->
        <section class="hero">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        <div class="hero__categories">
                            <div class="hero__categories__all">
                                <i class="fa fa-bars"></i>
                                <span>All departments</span>
                            </div>

                            @if( App\Models\Category::where('status', 1)->get()->count() > 0 )   
                            <ul class="main_ul">
                                @foreach ( App\Models\Category::where('status', 1)->get() as $category )
                                    <li class="category">
                                        <a href="#"><img src="{{ asset('backend/uploads/category/' . $category->icon ) }}" alt="" style="width: 20px; margin-right: 8px"> {{ $category->category_name }}</a>

                                        @if( App\Models\SubCategory::where('status', 1)->where('category_id', $category->id)->get()->count() > 0 ) 
                                        <ul class="sub_cat_list_nav">
                                            @foreach ( App\Models\SubCategory::where('status', 1)->where('category_id', $category->id)->get() as $SubCat )
                                            <li>
                                                <a href="#">{{ $SubCat->subcategory_name }}</a>

                                                @if( App\Models\ChildCategory::where('status', 1)->where('subcategory_id', $SubCat->id)->get()->count() > 0 )
                                                <ul class="child_cat">
                                                    @foreach ( App\Models\ChildCategory::where('status', 1)->where('subcategory_id', $SubCat->id)->get() as $ChildCat )
                                                    <li>
                                                        <a href="#">{{ $ChildCat->childCategory_name }}</a>
                                                    </li>
                                                    @endforeach
                                                </ul>
                                                @endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endforeach
                            </ul>
                            @endif
                        </div>
                    </div>
                    
                    <div class="col-lg-9">
                        <div class="hero__search">
                            <div class="hero__search__form">
                                <form action="#">
                                    <div class="hero__search__categories">
                                        All Categories
                                        <span class="arrow_carrot-down"></span>
                                    </div>
                                    <input type="text" placeholder="What do yo u need?">
                                    <button type="submit" class="site-btn">SEARCH</button>
                                </form>
                            </div>
                            <div class="hero__search__phone">
                                <div class="hero__search__phone__icon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <div class="hero__search__phone__text">
                                    <h5>+{{ $setting->phone_one }}</h5>
                                    <span>support 24/7 time</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Category nav Section End -->