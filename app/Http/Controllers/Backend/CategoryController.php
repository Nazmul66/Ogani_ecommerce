<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $categories = Category::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.category.manage', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // raw query system laravel ( 1st method )
        $data = array();
        $data['category_name']    =  $request->cat_name;
        $data['category_slug']    =  Str::slug($request->cat_name);
        $data['status']           =  $request->status;
        $data['home_page']        =  $request->home_page;

        if( $request->icon ){
            $manager  =  new ImageManager(new Driver());
            $image    =  $request->icon;
            $img      =  $manager->read($request->icon);

            $images = rand(0, 9999999) . "-icon-." . $image->getClientOriginalExtension();

            // images path location
            $location = public_path("backend/uploads/category/" . $images);

            // images size set
            $img->resize(600, 600);

            // to set images to their path location
            $img->toJpeg()->save($location);

            // added the images data to database
            $data['icon']   =  $images;
        }

        DB::table('categories')->insert($data);


        // eloquent relation system
        //( 2nd method )
        // Category::insert([
        //     "category_name"   => $request->cat_name,
        //     "category_slug"   => Str::slug($request->cat_name),
        //     "status"          => $request->status
        // ]);

        //( 3rd method )
        // $category = new Category();

        // if( !is_null($category) ){
        //     $category->category_name   = $request->cat_name;
        //     $category->category_slug   = Str::slug($request->cat_name);
        //     $category->status          = $request->status;

        //     $category->save();

        // }

        $notifications = [
            "message"    =>  "Category data has been added successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('category.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('backend.pages.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Raw laravel update system
        // $cat_id = $id;
        // $data = array();
        // $data['category_name']   = $request->cat_name;
        // $data['category_slug']   = Str::slug($request->cat_name);
        // $data['status']          =  $request->status;

        // DB::table('categories')->where('id', $cat_id)->update($data);


        // Eloquent update relationship system
        $category = Category::find($id);

        if( !is_null($category) ){
            $category->category_name      = $request->cat_name;
            $category->category_slug      = Str::slug($request->cat_name);
            $category->status             = $request->status;
            $category->home_page          = $request->home_page;

            if( $request->icon ){

                if( !empty($request->icon) ){
                    if( file_exists("backend/uploads/category/" . $category->icon ) == ""){
                        unlink("backend/uploads/category/" . $category->icon );
                    }
                    else if( file_exists("backend/uploads/category/" . $category->icon ) ){
                        unlink("backend/uploads/category/" . $category->icon );
                    }
                }
    
                $manager  =  new ImageManager(new Driver());
                $image    =  $request->icon;
                $img      =  $manager->read($request->icon);
    
                $images = rand(0, 9999999) . "-icon-." . $image->getClientOriginalExtension();
    
                // images path location
                $location = public_path("backend/uploads/category/" . $images);
    
                // images size set
                $img->resize(600, 600);
    
                // to set images to their path location
                $img->toJpeg()->save($location);
    
                // added the images data to database
                // $product->thumbnail = $images;
                $category->icon   =  $images;
            }

            $category->save();
        }

        $notifications = [
            "message"    =>  "Category data has been updated successfully",
            'alert-type' => "info"
        ];

        return redirect()->route('category.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::find($id);

        if( !is_null($category) ){
            $category->status = 2;

            $category->save();

            $notifications = [
                "message"    => "Data temporary delete",
                'alert-type' => "warning"
            ];

            return redirect()->route('category.manage')->with($notifications);
        }
    }

    /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $categories = Category::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.category.trash', compact('categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        // Raw delete laravel
        // DB::table('categories')->where('id', $id)->delete();


        // Eloquent relationship system
        $category = Category::find($id);

        if( !is_null($category) ){
            if( !is_null( $category->icon ) ){
                unlink("backend/uploads/category/" . $category->icon );
            }
            $category->delete();
        }

        $notifications = [
            "message"    => "Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }

    public function getChildCategory($id)
    {
       $data = ChildCategory::where('subcategory_id', $id)->get();
       return response()->json($data);
    }
}
