<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckoutController extends Controller
{
    public function checkoutPage()
    {
        if( Auth::check() ){
            return view('frontend.pages.cart.checkout');
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
