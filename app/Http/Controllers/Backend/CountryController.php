<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use Illuminate\Support\Str;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $countries = Country::orderBy('id', 'asc')->get();
        return view('backend.pages.country.manage', compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.country.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $country = new Country();

        if( !is_null($country) ){
            $country->name = $request->name;
            $country->slug = Str::slug($request->name);

            $country->save();

            $notifications = [
                "message"    => "New country inserted successfully",
                'alert-type' => "success"
            ];

            return redirect()->route('country.manage')->with($notifications);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $country = Country::find($id);
        return view('backend.pages.country.edit', compact('country'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $country = Country::find($id);

        if( !is_null($country) ){
            $country->name = $request->name;
            $country->slug = Str::slug($request->name);

            $country->save();

            $notifications = [
                "message"    => "country data updated successfully",
                'alert-type' => "info"
            ];

            return redirect()->route('country.manage')->with($notifications);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $country = Country::find($id);

        if( !is_null($country) ){
            $country->delete();

            $notifications = [
                "message"    => "country data delete successfully",
                'alert-type' => "error"
            ];

            return redirect()->back()->with($notifications);
        }
    }
}
