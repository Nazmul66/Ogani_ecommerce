<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $coupons = Coupon::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.coupon.manage', compact('coupons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.coupon.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $coupon = new Coupon();

        if( !is_null($coupon) ){
            $coupon->coupon_code        = $request->coupon_code;
            $coupon->type               = $request->coupon_type;
            $coupon->coupon_amount      = $request->coupon_amount;
            $coupon->valid_date         = $request->valid_date;
            $coupon->status             = $request->status;

            $coupon->save();

        }

        $notifications = [
            "message"    => "Coupon data added successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('coupon.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::find($id);
        return view('backend.pages.coupon.edit', compact('coupon'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Eloquent update relationship system
        $coupon = Coupon::find($id);

        if( !is_null($coupon) ){
            $coupon->coupon_code        = $request->coupon_code;
            $coupon->type               = $request->coupon_type;
            $coupon->coupon_amount      = $request->coupon_amount;
            $coupon->valid_date         = $request->valid_date;
            $coupon->status             = $request->status;

            $coupon->save();
        }

        $notifications = [
            "message"    => "Coupon data updated successfully",
            'alert-type' => "info"
        ];

        return redirect()->route('coupon.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $coupon = Coupon::find($id);

        if( !is_null($coupon) ){
            $coupon->status = 2;

            $coupon->save();

            $notifications = [
                "message"    => "Coupon data delete temporary",
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
        $coupons = Coupon::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.coupon.trash', compact('coupons'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        $coupon = Coupon::find($id);

        if( !is_null($coupon) ){
            $coupon->delete();
        }

        $notifications = [
            "message"    => "Coupon Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
