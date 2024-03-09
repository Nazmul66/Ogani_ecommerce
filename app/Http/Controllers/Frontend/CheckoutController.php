<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        if( Auth::check() ){
            $carts = Cart::where('user_id', Auth::user()->id)->get();
            return view('frontend.pages.cart.checkout', compact('carts'));
        }
        else{
            $notifications = [
                "message"    => "At first please login your account",
                'alert-type' => "warning",
            ];

           return redirect()->route('login')->with($notifications);
        }

    }
}
