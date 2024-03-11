<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function customerProfile()
    {
        $orders = Order::where("user_id", Auth::id())->get();
        $total_order     = Order::where("user_id", Auth::id())->count();
        $complete_order  = Order::where("user_id", Auth::id())->where('status', 3)->count();
        $return_order    = Order::where("user_id", Auth::id())->where('status', 4)->count();
        $cancel_order    = Order::where("user_id", Auth::id())->where('status', 5)->count();
        return view('frontend.pages.users.customer-dashboard', compact('orders', 'total_order', 'complete_order', 'return_order', 'cancel_order'));
    }

}
