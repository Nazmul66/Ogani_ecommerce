<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Support\Facades\Session;
use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

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
            if( date("Y-m-d", strtotime(date("Y-m-d")) ) <= date("Y-m-d", strtotime($checkCoupon->valid_date) ) ){
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
                    "message"    => "Sorry, Coupon is being Expire",
                    'alert-type' => "error",
                ];
    
                return redirect()->back()->with($notifications);
            }
        }
        else{
            $notifications = [
                "message"    => "Invalid Coupon",
                'alert-type' => "warning",
            ];
    
            return redirect()->back()->with($notifications);
        }
    }

    public function removeCoupon()
    {
        Session::forget('coupon');

        $notifications = [
            "message"    => "Coupon Removed!",
            'alert-type' => "error",
        ];
        return redirect()->back()->with($notifications);
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

    public function orderPlace(Request $request)
    {
       $order = new Order();

       if( !is_null($order) ){
           $order_id = "#" . rand(10000, 9999999999);

           $order->user_id             = Auth::id();
           $order->c_name              = $request->c_name;
           $order->c_country           = $request->c_country;
           $order->c_city              = $request->c_city;
           $order->c_address           = $request->c_address;
           $order->c_address_optional  = $request->c_address_optional;
           $order->c_zipCode           = $request->c_zipCode;
           $order->c_phone             = $request->c_phone;
           $order->c_phone_optional    = $request->c_phone_optional;
           $order->c_email             = $request->c_email;
            if(Session::has('coupon')){
                    $order->subtotal            = $request->subtotal;
                    $order->coupon_code         = Session::get('coupon')['coupon_name'];
                    $order->coupon_discount     = Session::get('coupon')['coupon_discount'];
                    $order->after_discount      = $request->subtotal - Session::get('coupon')['coupon_discount'];
                    $order->total               = $request->subtotal - Session::get('coupon')['coupon_discount'];
            }
            else{
                    $order->subtotal            = $request->subtotal;
                    $order->total               = $request->subtotal;
            }
           $order->payment_type        = $request->payment_type;
           $order->tax                 = 0;
           $order->shipping_charge     = 0;
           $order->order_id            = $order_id;
           $order->status              = 0;
           $order->date                = date('Y-m-d');
           $order->month               = date('F');
           $order->year                = date('Y');

           $order->save();

           // clear all cart items
           $carts = Cart::where('user_id', Auth::id())->get();
           foreach( $carts as $cart ){
               $cart->order_id = $order_id;
               $cart->save();
           }

           // session destroy for coupons after purchase
           if( Session::has('coupon') ){
               Session::forget('coupon');
           }

           // sending mail information
           $mailData = [
                'name'     => $request->c_name,
                'address'  => $request->c_address,
                'mail'     => $request->c_email,
           ];

           $customerMail = [$request->c_email, "hnazmul748@gmail.com"];
           Mail::to($customerMail)->send(new InvoiceMail($mailData));

           $notifications = [
            "message"    => "order placed successfully",
            'alert-type' => "success",
          ];

          return redirect()->route('homePage')->with($notifications);
       }
    }
}
