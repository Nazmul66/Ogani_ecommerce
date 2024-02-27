<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Brand;
use Illuminate\Support\Str;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $brands = Brand::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.brand.manage', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $brand = new Brand();

        if( !is_null( $brand ) ){
            $slug = Str::slug( $request->brand_name );
            $brand->brand_name   = $request->brand_name;
            $brand->brand_slug   = Str::slug( $request->brand_name );
            $brand->front_page   = $request->front_page;

            if( $request->brandLogo ){
                $manager  =  new ImageManager(new Driver());
                $image    =  $request->brandLogo;
                $img      =  $manager->read($request->brandLogo);

                $images = $slug . "-brand-." . $image->getClientOriginalExtension();

                // images size set
                $img->resize(100, 100);

                // images path location
                $location = public_path("backend/uploads/brand/" . $images);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $brand->brand_logo = $images;
            }

            $brand->status       = $request->status;
            // dd($brand);
        }
        $brand->save();

        $notifications = [
            "message"    =>  "Brand inserted successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('brand.manage')->with($notifications);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $brand = Brand::find($id);
        return view('backend.pages.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $brand = Brand::find($id);

        if( !is_null( $brand ) ){
            $slug = Str::slug( $request->brand_name );
            $brand->brand_name   = $request->brand_name;
            $brand->brand_slug   = Str::slug( $request->brand_name );
            $brand->front_page   = $request->front_page;

            if( $request->brandLogo ){
                
                if( file_exists("backend/uploads/brand/" . $brand->brand_logo ) == ""){
                    unlink("backend/uploads/brand/" . $brand->brand_logo );
                }
                else if( file_exists("backend/uploads/brand/" . $brand->brand_logo ) ){
                    unlink("backend/uploads/brand/" . $brand->brand_logo );
                }

                $manager  =  new ImageManager(new Driver());
                $image    =  $request->brandLogo;
                $img      =  $manager->read($request->brandLogo);

                $images = $slug . "-brand-." . $image->getClientOriginalExtension();

                // images size set
                $img->resize(100, 100);

                // images path location
                $location = public_path("backend/uploads/brand/" . $images);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $brand->brand_logo = $images;
            }

            $brand->status       = $request->status;
        }
        $brand->save();

        $notifications = [
            "message"    =>  "Brand Updated successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('brand.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = Brand::find($id);

        if( !is_null($brand) ){
            $brand->status = 2;

            $brand->save();

            $notifications = [
                "message"    => "brand Data delete temporary",
                'alert-type' => "warning"
            ];

            return redirect()->route('brand.manage')->with($notifications);
        }
    }


     /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $brands = Brand::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.brand.trash', compact('brands'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        // Raw delete laravel
        // DB::table('categories')->where('id', $id)->delete();


        // Eloquent relationship system
        $brand = Brand::find($id);

        if( !is_null($brand) ){
            $brand->delete();
        }

        $notifications = [
            "message"    => "Brand Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}

