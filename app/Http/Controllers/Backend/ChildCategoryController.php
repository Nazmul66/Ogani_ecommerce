<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $child_categories = ChildCategory::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.childCategory.manage', compact('child_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('category_name', 'asc')->where('status', 1)->get();
        return view('backend.pages.childCategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $sub_cat = SubCategory::where('id', $request->sub_id)->where('status', 1)->first();
        
        $child_cat = new ChildCategory();

        if( !is_null($child_cat) ){
            $child_cat->category_id          = $sub_cat->category_id;
            $child_cat->subcategory_id       = $sub_cat->id;
            $child_cat->childCategory_name   = $request->childCat_name;
            $child_cat->childCategory_slug   = Str::slug($request->childCat_name);
            $child_cat->status               = $request->status;

            $child_cat->save();
        }

        $notifications = [
            "message"     =>   "ChildCategory data inserted successfully",
            'alert-type'  =>   "success"
        ];

        return redirect()->route('childCategory.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $child_cat = ChildCategory::find($id);
        $categories = Category::orderBy('category_name', 'asc')->where('status', 1)->get();
        return view('backend.pages.childCategory.edit', compact('child_cat', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $sub_cat = SubCategory::where('id', $request->sub_id)->where('status', 1)->first();
        
        $child_cat = ChildCategory::find($id);

        if( !is_null($child_cat) ){
            $child_cat->category_id          = $sub_cat->category_id;
            $child_cat->subcategory_id       = $sub_cat->id;
            $child_cat->childCategory_name   = $request->childCat_name;
            $child_cat->childCategory_slug   = Str::slug($request->childCat_name);
            $child_cat->status               = $request->status;

            $child_cat->save();
        }

        $notifications = [
            "message"     =>   "ChildCategory data updated successfully",
            'alert-type'  =>   "success"
        ];

        return redirect()->route('childCategory.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $child_cat = ChildCategory::find($id);

        if( !is_null($child_cat) ){
            $child_cat->status = 2;

            $child_cat->save();

            $notifications = [
                "message"    => "child Data temporary delete",
                'alert-type' => "warning"
            ];

            return redirect()->route('childCategory.manage')->with($notifications);
        }
    }

    /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $child_categories = ChildCategory::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.childCategory.trash', compact('child_categories'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        // Raw delete laravel
        // DB::table('categories')->where('id', $id)->delete();


        // Eloquent relationship system
        $child_cat = ChildCategory::find($id);

        if( !is_null($child_cat) ){
            $child_cat->delete();
        }

        $notifications = [
            "message"    => "Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
