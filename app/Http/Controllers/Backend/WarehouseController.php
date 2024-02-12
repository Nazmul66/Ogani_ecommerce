<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Warehouse;

class WarehouseController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $warehouses = Warehouse::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.warehouse.manage', compact('warehouses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.warehouse.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $warehouse = new Warehouse();

        if( !is_null($warehouse) ){
            $warehouse->warehouse_name       = $request->warehouse_name;
            $warehouse->warehouse_address    = $request->warehouse_address;
            $warehouse->warehouse_phone      = $request->warehouse_phone;
            $warehouse->status               = $request->status;

            $warehouse->save();

        }

        $notifications = [
            "message"    =>  "Warehouse data added successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('warehouse.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $warehouse = Warehouse::find($id);
        return view('backend.pages.warehouse.edit', compact('warehouse'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Eloquent update relationship system
        $warehouse = Warehouse::find($id);

        if( !is_null($warehouse) ){
            $warehouse->warehouse_name       = $request->warehouse_name;
            $warehouse->warehouse_address    = $request->warehouse_address;
            $warehouse->warehouse_phone      = $request->warehouse_phone;
            $warehouse->status               = $request->status;

            $warehouse->save();
        }

        $notifications = [
            "message"    =>  "Warehouse data updated successfully",
            'alert-type' => "info"
        ];

        return redirect()->route('warehouse.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $warehouse = Warehouse::find($id);

        if( !is_null($warehouse) ){
            $warehouse->status = 2;

            $warehouse->save();

            $notifications = [
                "message"    => "Warehouse data delete temporary",
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
        $warehouses = Warehouse::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.warehouse.trash', compact('warehouses'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        $warehouse = Warehouse::find($id);

        if( !is_null($warehouse) ){
            $warehouse->delete();
        }

        $notifications = [
            "message"    => "Warehouse Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
