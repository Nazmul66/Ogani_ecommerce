<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog_category;
use Illuminate\Support\Str;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $blog_categories = Blog_category::orderBy('id', 'asc')->get();
        return view('backend.pages.blog.manage', compact('blog_categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $blogCategory = new Blog_category();

        if( !is_null($blogCategory) ){
            $blogCategory->category_name = $request->category_name;
            $blogCategory->category_slug = Str::slug($request->category_name);

            $blogCategory->save();

            $notifications = [
                "message"    => "Blog Category inserted successfully",
                'alert-type' => "success"
            ];
    
            return redirect()->route('blog.manage')->with($notifications);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog_category = Blog_category::find($id);
        return view('backend.pages.blog.edit',  compact('blog_category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $blog_category = Blog_category::find($id);

        if( !is_null($blog_category) ){
            $blog_category->category_name = $request->category_name;
            $blog_category->category_slug = Str::slug($request->category_name);

            $blog_category->save();
                
            $notifications = [
                "message"    => "Blog Category Data Updated",
                'alert-type' => "info"
            ];

            return redirect()->route('blog.manage')->with($notifications);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog_category = Blog_category::find($id);

        if( !is_null($blog_category) ){
            $blog_category->delete();
        }

        $notifications = [
            "message"    => "Blog Category Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
