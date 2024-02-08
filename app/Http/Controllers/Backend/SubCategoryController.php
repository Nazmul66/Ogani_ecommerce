<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use Illuminate\Support\Str;

class SubCategoryController extends Controller
{
      /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $categories = Category::orderBy('category_name', 'asc')->where('status', 1)->get();
        $sub_categories = SubCategory::orderBy('subcategory_name', 'asc')->where('status', 1)->get();
        return view('backend.pages.subCategory.manage', compact('sub_categories', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->where('status', 1)->get();
        return view('backend.pages.subCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sub_cat = new SubCategory();

        if( !is_null($sub_cat) ){
            $sub_cat->category_id        = $request->cat_id;
            $sub_cat->subcategory_name   = $request->subCat_name;
            $sub_cat->subcategory_slug   = Str::slug($request->subCat_name);
            $sub_cat->status             = $request->status;

            $sub_cat->save();
        }

        $notifications = [
            "message"    =>  "SubCategory data has been inserted",
            'alert-type' => "success"
        ];

        return redirect()->route('subCategory.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories  = Category::where('status', 1)->get();
        $sub_cat     = SubCategory::find($id);
        return view('backend.pages.subCategory.edit', compact('sub_cat', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sub_cat = SubCategory::find($id);

        if( !is_null($sub_cat) ){
            $sub_cat->category_id        = $request->cat_id;
            $sub_cat->subcategory_name   = $request->subCat_name;
            $sub_cat->subcategory_slug   = Str::slug($request->subCat_name);
            $sub_cat->status             = $request->status;

            $sub_cat->save();
        }

        $notifications = [
            "message"    =>  "SubCategory data has been updated",
            'alert-type' => "info"
        ];

        return redirect()->route('subCategory.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $sub_cat = SubCategory::find($id);

        if( !is_null($sub_cat) ){
            $sub_cat->status = 2;

            $sub_cat->save();

            $notifications = [
                "message"    => "Data temporary delete",
                'alert-type' => "warning"
            ];

            return redirect()->route('subCategory.manage')->with($notifications);
        }
    }

    /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $categories      =  Category::orderBy('category_name', 'asc')->get();
        $sub_categories  =  SubCategory::orderBy('subcategory_name', 'asc')->where('status', 2)->get();
        return view('backend.pages.subCategory.trash', compact('categories', 'sub_categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        // Raw delete laravel
        // DB::table('categories')->where('id', $id)->delete();


        // Eloquent relationship system
        $category = SubCategory::find($id);

        if( !is_null($category) ){
            $category->delete();
        }

        $notifications = [
            "message"    => "Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
