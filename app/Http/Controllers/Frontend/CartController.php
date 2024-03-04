<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Coupon;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if( !Auth::check() ){
            $notifications = [
                "message"    => "At first please login your account",
                'alert-type' => "warning",
            ];

           return redirect()->route('login')->with($notifications);
        }

        else{
           $carts = Cart::where('user_id', Auth::id())->where('order_id', NULL)->get();
           return view('frontend.pages.shop.shopping-cart', compact('carts'));
        }
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
                $cart->increment('product_qty');
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
                $carts->product_qty  =  $request->quantity ?? 1;
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
     * Update the specified resource in storage.
     */
    public function applyCoupon(Request $request)
    {
        $checkCoupon = Coupon::where('coupon_code', $request->coupon)->first();

        if( !is_null($checkCoupon) ){
          Session::put('coupon', [
               'coupon_name' => $checkCoupon->coupon_code,
               'coupon_discount' => $checkCoupon->coupon_amount
          ]);

            $notifications = [
                "message"    => "Successfully Coupon added",
                'alert-type' => "success",
            ];

            return redirect()->back()->with($notifications);
        }
        else{
            $notifications = [
                "message"    => "Invalid Coupon",
                'alert-type' => "warning",
            ];
    
            return redirect()->back()->with($notifications);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $cart = Cart::find($id);

        if( !is_null($cart) ){
            $cart->delete();
        }

        $notifications = [
            "message"    => "Item delete into the cart",
            'alert-type' => "error",
        ];

        return redirect()->back()->with($notifications);
    }
}
