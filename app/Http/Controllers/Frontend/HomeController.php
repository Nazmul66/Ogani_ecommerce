<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Pickup_point;
use App\Models\ProductImage;
use App\Models\Setting;
use App\Models\Review;
use App\Models\User;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function home()
    {
        $product = Product::where('product_slide', 2)->where('status', 1)->first();
        return view('frontend.home', compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function productDetails(string $slug)
    { 
        $products         =  Product::where('slug', $slug)->first();
        $users            =  User::all();
        $category         =  Category::where('id', $products->category_id)->first();
        $brand            =  Brand::where('id', $products->brand_id)->first();
        $productImg       =  ProductImage::where('product_id', $products->id)->get();
        $pickup_point     =  Pickup_point::where('id', $products->	pickup_point_id)->first();
        $related_product  =  Product::orderBy('id', 'desc')->where('subCategory_id', $products->subCategory_id )->where('status', 1)->take(10)->get();
        $review_products  = Review::orderBy('id', 'desc')->where('product_id', $products->id)->get();

        return view('frontend.pages.shop.shop-details', compact('products', 'category', 'brand', 'productImg', 'pickup_point', 'related_product', 'review_products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function userLogin()
    {
        $setting = Setting::orderBy('id', 'asc')->first();
        return view('frontend.pages.auth.login', compact('setting'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
