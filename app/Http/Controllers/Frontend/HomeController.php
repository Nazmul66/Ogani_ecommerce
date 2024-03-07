<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use App\Models\Brand;
use App\Models\Pickup_point;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Review;
use App\Models\User; 
use App\Models\Newsletter; 
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $cartSummary       = getCartSummary();
        $setting           = Setting::orderBy('id', 'asc')->first();
        $product           = Product::where('product_slide', 2)->where('status', 1)->first();
        $featured_product  = Product::where('featured', 1)->where('status', 1)->get();
        $popular_product   = Product::orderBy('product_view', 'DESC')->where('status', 1)->limit(10)->get();
        $random_products   = Product::inRandomOrder()->where('status', 1)->limit(10)->get();
        $trendy_product    = Product::where('trendy', 1)->where('status', 1)->limit(10)->get();
        $brand_logos       = Brand::where('status', 1)->where('front_page', 1)->inRandomOrder()->limit(12)->get();
        $home_category     = DB::table('categories')->where('home_page', 1)->orderBy('category_name', 'asc')->get();
        return view('frontend.home', compact('product', 'featured_product', 'popular_product', 'trendy_product', 'home_category', 'brand_logos', 'random_products', 'setting', 'cartSummary'));
    }

    /**
    * Show the form for creating a new resource.
    */
    public function productDetails(string $slug)
    { 
        $cartSummary       = getCartSummary();
        $products          =  Product::where('slug', $slug)->first();
                              Product::where('slug', $slug)->increment('product_view');
        $users             =  User::all();
        $category          =  Category::where('id', $products->category_id)->first();
        $brand             =  Brand::where('id', $products->brand_id)->first();
        $productImg        =  ProductImage::where('product_id', $products->id)->get();
        $pickup_point      =  Pickup_point::where('id', $products->	pickup_point_id)->first();
        $related_product   =  Product::orderBy('id', 'desc')->where('category_id', $products->category_id  )->where('status', 1)->take(8)->get();
        $review_products   =  Review::orderBy('id', 'desc')->where('product_id', $products->id)->get();

        return view('frontend.pages.shop.shop-details', compact('cartSummary', 'products', 'category', 'brand', 'productImg', 'pickup_point', 'related_product', 'review_products', 'users'));
    }

    /**
    * Store a newly created resource in storage.
    */
    public function userLogin()
    {
        $setting   =  Setting::orderBy('id', 'asc')->first();
        return view('frontend.pages.auth.login', compact('setting'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function shopPage()
    {
        $categories        = Category::orderBy('id', 'asc')->where('status', 1)->get();
        $products          = Product::inRandomOrder()->orderBy('id', 'desc')->limit(9)->get();
        $productSales      = Product::whereNotNull('discount_price')->inRandomOrder()->orderBy('id', 'desc')->get();
        $brands            = Brand::orderBy('id', 'asc')->get();
        $random_products   = Product::inRandomOrder()->where('status', 1)->limit(10)->get();
        return view('frontend.pages.shop.shop', compact('categories', 'products', 'brands', 'productSales', 'random_products'));
    }

    public function categoryWiseProduct(string $id)
    {
    //    dd($id);
       $category           = Category::where('id', $id)->first();
       $subCategories      = SubCategory::where('category_id', $id)->get();
       $brands             = Brand::orderBy('id', 'asc')->get();
       $products           = Product::orderBy('id', 'desc')->where('category_id', $id)->get();
       $productSales       = Product::whereNotNull('discount_price')->inRandomOrder()->orderBy('id', 'desc')->get();
       $random_products    = Product::inRandomOrder()->where('status', 1)->limit(10)->get();
       return  view('frontend.pages.shop.categoryWise-product', compact( 'category', 'products', 'brands', 'productSales', 'subCategories', 'random_products'));
    }

    public function subCategoryWiseProduct(string $id)
    {
        $subCat              = SubCategory::where('id', $id)->first();
        $childCategories     = ChildCategory::where('subcategory_id', $id)->get();
        $brands              = Brand::orderBy('id', 'asc')->get();
        $products            = Product::orderBy('id', 'desc')->where('subcategory_id', $id)->get();
        $productSales        = Product::whereNotNull('discount_price')->inRandomOrder()->orderBy('id', 'desc')->get();
        $random_products     = Product::inRandomOrder()->where('status', 1)->limit(10)->get();
        return  view('frontend.pages.shop.subCatWise-product', compact( 'subCat', 'products', 'brands', 'productSales', 'childCategories', 'random_products'));
    }

    public function childCategoryWise(string $id)
    {
        $products            = Product::orderBy('id', 'desc')->where('childCategory_id', $id)->get();
        $childCat            = ChildCategory::where('id', $id)->first();
        $Categories          = Category::orderBy('id', 'asc')->where('status', 1)->get();
        $brands              = Brand::orderBy('id', 'asc')->get();
        $productSales        = Product::whereNotNull('discount_price')->inRandomOrder()->orderBy('id', 'desc')->get();
        $random_products     = Product::inRandomOrder()->where('status', 1)->limit(10)->get();
        return view('frontend.pages.shop.childCatWise-product', compact( 'childCat', 'products', 'brands', 'productSales', 'Categories', 'random_products'));
    }


    public function brandWiseProduct(string $id)
    {
        $brand               = Brand::where('id', $id)->where('status', 1)->first();
        $brands              = Brand::orderBy('id', 'asc')->get();
        $Categories          = Category::orderBy('id', 'asc')->where('status', 1)->get();
        $products            = Product::orderBy('id', 'desc')->where('brand_id', $id)->get();
        $productSales        = Product::whereNotNull('discount_price')->inRandomOrder()->orderBy('id', 'desc')->get();
        $random_products     = Product::inRandomOrder()->where('status', 1)->limit(10)->get();
        return view('frontend.pages.shop.brandWise-product', compact( 'brand', 'products', 'brands', 'productSales', 'Categories', 'random_products'));
    }

    public function blogPage()
    {
       return view('frontend.pages.static.blog');
    }

    public function newsLetter(Request $request)
    {
        $check = Newsletter::where('email', $request->email)->first();

        if($check){
            $notifications = [
                "message"    => "Subscription email already exists",
                'alert-type' => "error",
            ];
    
            return redirect()->back()->with($notifications);
        }
        else{
            $newsletter = new Newsletter();

            if( !is_null($newsletter) ){
                $newsletter->email = $request->email;
    
                $newsletter->save();
    
                $notifications = [
                    "message"    => "Thanks for your subscription",
                    'alert-type' => "success",
                ];
        
                return redirect()->back()->with($notifications);
            }
        }
    }

}
