<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pickup_point;

class PickupController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $pickup_points = Pickup_point::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.pickup_point.manage', compact('pickup_points'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.pickup_point.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $pickup_point = new Pickup_point();

        if( !is_null($pickup_point) ){
            $pickup_point->pickup_point_name         = $request->pickup_point_name;
            $pickup_point->pickup_point_address      = $request->pickup_point_address;
            $pickup_point->pickup_point_phone        = $request->pickup_point_phone;
            $pickup_point->pickup_point_phone_two    = $request->pickup_point_phone_two;
            $pickup_point->status                    = $request->status;

            $pickup_point->save();

        }

        $notifications = [
            "message"    => "Pickup point data added successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('pickup.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $pickup_point = Pickup_point::find($id);
        return view('backend.pages.pickup_point.edit', compact('pickup_point'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Eloquent update relationship system
        $pickup_point = Pickup_point::find($id);

        if( !is_null($pickup_point) ){
            $pickup_point->pickup_point_name         = $request->pickup_point_name;
            $pickup_point->pickup_point_address      = $request->pickup_point_address;
            $pickup_point->pickup_point_phone        = $request->pickup_point_phone;
            $pickup_point->pickup_point_phone_two    = $request->pickup_point_phone_two;
            $pickup_point->status                    = $request->status;

            $pickup_point->save();
        }

        $notifications = [
            "message"    => "Pickup point data updated successfully",
            'alert-type' => "info"
        ];

        return redirect()->route('pickup.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $pickup_point = Pickup_point::find($id);

        if( !is_null($pickup_point) ){
            $pickup_point->status = 2;

            $pickup_point->save();

            $notifications = [
                "message"    => "Pickup point data delete temporary",
                'alert-type' => "warning"
            ];

            return redirect()->back()->with($notifications);
        }
    }

    /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $pickup_points = Pickup_point::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.pickup_point.trash', compact('pickup_points'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        $pickup_point = Pickup_point::find($id);

        if( !is_null($pickup_point) ){
            $pickup_point->delete();
        }

        $notifications = [
            "message"    => "Pickup point Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
