<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $orders = Order::where("user_id",  Auth::id())->orderBy("id", "asc")->get();
        return view("backend.pages.order.manage", compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $order = Order::find($id);
        $carts =  Cart::where('order_id', $order->id)->get();
        return view("backend.pages.order.order-status", compact('order', 'carts'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $orderUpdate = Order::where('id', $id)->first();

        if( !is_null($orderUpdate) ){
            $orderUpdate->status = $request->update_status;
            $orderUpdate->save();
        }

        $notifications = [
            "message"     =>   "Order Status updated",
            'alert-type'  =>   "info"
        ];

        return redirect()->back()->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
