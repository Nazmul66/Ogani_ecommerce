<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Country;
use App\Models\Division;
use Illuminate\Support\Str;

class DivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $divisions   = Division::orderBy('id', 'asc')->where('status', 1)->get();
        $countries   = Country::orderBy('id', 'asc')->get();
        return view('backend.pages.division.manage', compact('divisions', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::orderBy('id', 'asc')->get();
        return view('backend.pages.division.create', compact('countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $division = new Division();

        if( !is_null($division) ){
            $division->country_id      = $request->country_id;
            $division->division_name   = $request->name;
            $division->division_slug   = Str::slug($request->name);
            $division->status          = $request->status;

            $division->save();

            $notifications = [
                "message"    => "New country inserted successfully",
                'alert-type' => "success"
            ];

            return redirect()->route('division.manage')->with($notifications);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $division = Division::find($id);
        $countries = Country::orderBy('id', 'asc')->get();
        return view('backend.pages.division.edit', compact('countries', 'division'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $division = Division::find($id);

        if( !is_null($division) ){
            $division->country_id      = $request->country_id;
            $division->division_name   = $request->name;
            $division->division_slug   = Str::slug($request->name);
            $division->status          = $request->status;

            $division->save();

            $notifications = [
                "message"    => "Division data updated successfully",
                'alert-type' => "info"
            ];

            return redirect()->route('division.manage')->with($notifications);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $division = Division::find($id);

        if( !is_null($division) ){
            $division->status = 2;

            $division->save();

            $notifications = [
                "message"    => "Division data delete temporary",
                'alert-type' => "warning"
            ];

            return redirect()->back()->with($notifications);

        }
    }

    public function trashManage()
    {
        $divisions   =  Division::orderBy('id', 'asc')->where('status', 2)->get();
        $countries   =  Country::orderBy('id', 'asc')->get();
        return view('backend.pages.division.trash-manage', compact('divisions', 'countries'));
    }

    public function trashDestroy(string $id)
    {
        $division = Division::find($id);

        if( !is_null($division) ){
            $division->delete();

            $notifications = [
                "message"    => "Division data delete Permanently",
                'alert-type' => "error"
            ];

            return redirect()->back()->with($notifications);

        }
    }
}
