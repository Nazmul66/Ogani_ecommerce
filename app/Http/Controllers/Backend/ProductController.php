<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\ChildCategory;
use App\Models\Pickup_point;
use App\Models\Warehouse;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $categories   =  Category::where('status', 1)->get();
        $sub_cats     =  SubCategory::where('status', 1)->get();
        $child_cats   =  ChildCategory::orderBy('id', 'asc')->where('status', 1)->get();
        $brands       =  Brand::where('status', 1)->get();
        $products     =  Product::orderBy('product_name', 'asc')->where('status', 1)->get();
        return view('backend.pages.products.manage',compact('products', 'categories', 'sub_cats', 'child_cats', 'brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories     = Category::where('status', 1)->get();
        $child_cats     = Category::where('status', 1)->get();
        $brands         = Brand::where('status', 1)->get();
        $pickup_points  = Pickup_point::where('status', 1)->get();
        $warehouses     = Warehouse::where('status', 1)->get();
        return view('backend.pages.products.create', compact('categories', 'brands', 'pickup_points', 'warehouses', 'child_cats'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $product = new Product();
        $subCat  = SubCategory::where('id', $request->subCat_id)->first();

        if( !is_null($product) ){

            $validated = $request->validate([
                'product_name'     => 'required|unique:products',
                'product_code'     => 'required|unique:products|max:55',
                'subCat_id'        => 'required',
                'brand_id'         => 'required',
                'selling_price'    => 'required',
                'color'            => 'required',
                'description'      => 'required',
            ]);

            $slug = Str::slug($request->product_name);

            $product->product_name            =   $request->product_name;
            $product->slug                    =   Str::slug($request->product_name);
            $product->product_code            =   $request->product_code;
            $product->category_id             =   $subCat->category_id;
            $product->subCategory_id          =   $subCat->id;
            $product->childCategory_id        =   $request->childCategory_id;
            $product->brand_id                =   $request->brand_id;
            $product->pickup_point_id         =   $request->pickup_point_id;
            $product->product_unit            =   $request->product_unit;
            $product->product_tags            =   $request->product_tags;
            $product->purchase_price          =   $request->purchase_price;
            $product->selling_price           =   $request->selling_price;
            $product->discount_price          =   $request->discount_price;
            $product->warehouse               =   $request->warehouse_id;
            $product->quantity_stock          =   $request->quantity_stock;
            $product->color                   =   $request->color;
            $product->size                    =   $request->size;
            $product->description             =   $request->description;
            $product->video                   =   $request->video;
            $product->featured                =   $request->featured;
            $product->today_deal              =   $request->today_deal;
            $product->status                  =   $request->status;
            $product->admin_id                =   Auth::user()->id;
            $product->date                    =   date('d-m-y');
            $product->month                   =   date('F');

            // single thumbnail
            if( $request->thumbnail ){
                $manager  =  new ImageManager(new Driver());
                $image    =  $request->thumbnail;
                $img      =  $manager->read($request->thumbnail);

                $images = $slug . "-thumbnail-." . $image->getClientOriginalExtension();

                // images path location
                $location = public_path("backend/uploads/products/" . $images);

                // images size set
                $img->resize(600, 600);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $product->thumbnail = $images;
            }

            if( $request->hasFile('images') ){
                $allImages = array();

                foreach( $request->images as $key=>$image ){
                    $manager  =  new ImageManager(new Driver());
                    $img      =  $manager->read($image);
    
                    $images = hexdec(uniqid()) . "-images-." . $image->getClientOriginalExtension();
    
                    // images path location
                    $location = public_path("backend/uploads/products/" . $images);
    
                    // images size set
                    $img->resize(600, 600);
    
                    // to set images to their path location
                    $img->toJpeg()->save($location);

                    array_push($allImages, $images);

                    $product->images = json_encode($allImages);
                }
                
            }

            // dd($product);
            $product->save();

            $notifications = [
                "message"    => "Product data added successfully",
                'alert-type' => "success"
            ];
    
            return redirect()->route('product.manage')->with($notifications);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product        = Product::find($id);
        $categories     = Category::where('status', 1)->get();
        $child_cats     = Category::where('status', 1)->get();
        $brands         = Brand::where('status', 1)->get();
        $pickup_points  = Pickup_point::where('status', 1)->get();
        $warehouses     = Warehouse::where('status', 1)->get();
        return view('backend.pages.products.edit', compact('product', 'categories', 'brands', 'pickup_points', 'warehouses', 'child_cats'));
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
        $product  =  Product::find($id);

        if( !is_null($product) ){
            $product->status = 2;
            $product->save();
        }

        $notifications = [
            "message"    => "Product data delete temporary",
            'alert-type' => "info"
        ];

        return redirect()->back()->with($notifications);
    }

     /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $categories   =  Category::where('status', 1)->get();
        $sub_cats     =  SubCategory::where('status', 1)->get();
        $child_cats   =  ChildCategory::orderBy('id', 'asc')->where('status', 1)->get();
        $brands       =  Brand::where('status', 1)->get();
        $products     =  Product::orderBy('product_name', 'asc')->where('status', 2)->get();
        return view('backend.pages.products.trash',compact('products', 'categories', 'sub_cats', 'child_cats', 'brands'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        $product  =  Product::find($id);

        if( !is_null($product) ){
            $product->delete();
        }

        $notifications = [
            "message"    => "Product data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
