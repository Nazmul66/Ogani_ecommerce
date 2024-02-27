<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if( !Auth::check() ){
            return redirect()->route('login');
        }
        else{
            $cart = Cart::where('user_id', Auth::id())->where('product_id', $request->prdct_id)->where('order_id', NULL)->first();
        }

        if( !is_null( $cart ) ){
            if( !is_null( $request->quantity ) ){
                $cart->product_qty = $cart->product_qty + $request->quantity;
            }
            else{
                $cart->increment('quantity');
            }

            $cart->save();

            $notifications = [
                "message"    => "Item Quantity updated in your cart",
                'alert-type' => "success",
            ];
    
            return redirect()->back()->with($notifications);
        }
        else{
            $carts = new Cart();

            if( !is_null($carts) ){

                if( Auth::check() ){
                    $carts->user_id = Auth::id();
                }
                $carts->product_id   =  $request->prdct_id;
                $carts->ip_address   =  $request->ip();
                $carts->product_qty  =  $request->quantity;
                $carts->color        =  $request->color;
                $carts->size         =  $request->size ;

                $carts->save();

                $notifications = [
                    "message"    => "Item added into cart",
                    'alert-type' => "success",
                ];
        
                return redirect()->back()->with($notifications);
            }
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
