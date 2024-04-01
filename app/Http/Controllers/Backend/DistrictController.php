<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Division;
use App\Models\District;
use App\Models\Country;
use Illuminate\Support\Str;

class DistrictController extends Controller
{
       /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $districts   = District::orderBy('id', 'asc')->where('status', 1)->get();
        $divisions   = Division::orderBy('id', 'asc')->get();
        $countries   = Country::orderBy('id', 'asc')->get();
        return view('backend.pages.district.manage', compact('divisions', 'districts', 'countries'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries   = Country::orderBy('id', 'asc')->get();
        $divisions   = Division::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.district.create', compact('divisions', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $district = new District();

        if( !is_null($district) ){
            $district->country_id      = $request->country_id;
            $district->division_id     = $request->division_id;
            $district->district_name   = $request->district_name;
            $district->cash            = $request->shipping_cost;
            $district->status          = $request->status;

            // dd($district);
            $district->save();

            $notifications = [
                "message"    => "New distrct inserted successfully",
                'alert-type' => "success"
            ];

            return redirect()->route('district.manage')->with($notifications);

        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $district    = District::find($id);
        $countries   = Country::orderBy('id', 'asc')->get();
        $divisions   = Division::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.district.edit', compact('countries', 'divisions', 'district'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $district = District::find($id);

        if( !is_null($district) ){
            $district->country_id      = $request->country_id;
            $district->division_id     = $request->division_id;
            $district->district_name   = $request->district_name;
            $district->cash            = $request->shipping_cost;
            $district->status          = $request->status;

            $district->save();

            $notifications = [
                "message"    => "District data updated successfully",
                'alert-type' => "info"
            ];

            return redirect()->route('district.manage')->with($notifications);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $district = District::find($id);

        if( !is_null($district) ){
            $district->status = 2;

            $district->save();

            $notifications = [
                "message"    => "District data delete temporary",
                'alert-type' => "warning"
            ];

            return redirect()->back()->with($notifications);

        }
    }

    public function trashManage()
    {
        $districts   = District::orderBy('id', 'asc')->where('status', 2)->get();
        $divisions   = Division::orderBy('id', 'asc')->get();
        $countries   = Country::orderBy('id', 'asc')->get();
        return view('backend.pages.district.trash-manage', compact('divisions', 'districts', 'countries'));
    }

    public function trashDestroy(string $id)
    {
        $district = District::find($id);

        if( !is_null($district) ){
            $district->delete();

            $notifications = [
                "message"    => "District data delete Permanently",
                'alert-type' => "error"
            ];

            return redirect()->back()->with($notifications);

        }
    }
}
