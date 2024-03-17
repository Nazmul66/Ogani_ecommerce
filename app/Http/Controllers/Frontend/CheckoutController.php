<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart; 
use App\Models\User; 
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        if( Auth::check() ){
            $carts = Cart::where('user_id', Auth::user()->id)->where('order_id', NULL)->get();
            $users = User::where('id', Auth::user()->id)->first();
            return view('frontend.pages.cart.checkout', compact('carts', 'users'));
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
