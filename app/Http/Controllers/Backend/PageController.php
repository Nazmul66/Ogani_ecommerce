<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $pages = Page::orderBy('id', 'asc')->get();
        return view('backend.pages.setting.pages.manage', compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.setting.pages.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pages = new Page();

        if( !is_null($pages) ){
            $pages->page_position      = $request->page_position;
            $pages->page_name          = $request->page_name;
            $pages->page_url           = $request->page_url;
            $pages->page_description   = $request->page_description;

            $pages->save();
            
            $notifications = [
                "message"    => "New page inserted successfully",
                'alert-type' => "success",
            ];

            return redirect()->route('page.manage')->with($notifications);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pages = Page::where('id', $id)->first();
        return view('backend.pages.setting.pages.edit', compact('pages'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pages = Page::find($id);

        if( !is_null($pages) ){
            $pages->page_position      = $request->page_position;
            $pages->page_name          = $request->page_name;
            $pages->page_title         = $request->page_title;
            $pages->page_description   = $request->page_description;

            $pages->save();
            
            $notifications = [
                "message"    => "Page updated successfully",
                'alert-type' => "success",
            ];

            return redirect()->route('page.manage')->with($notifications);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pages = Page::find($id);

        if( !is_null($pages) ){
            $pages->delete();

            $notifications = [
                "message"    => "Page deleted successfully",
                'alert-type' => "error",
            ];

            return redirect()->route('page.manage')->with($notifications);
        }
    }
}
