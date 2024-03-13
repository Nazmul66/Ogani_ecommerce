<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function customerProfile()
    {
        $orders          = Order::where("user_id", Auth::id())->get();
        $wishlists       = Wishlist::where('user_id', Auth::id())->get();
        $total_order     = Order::where("user_id", Auth::id())->count();
        $complete_order  = Order::where("user_id", Auth::id())->where('status', 3)->count();
        $return_order    = Order::where("user_id", Auth::id())->where('status', 4)->count();
        $cancel_order    = Order::where("user_id", Auth::id())->where('status', 5)->count();
        return view('frontend.pages.users.customer-dashboard', compact('orders', 'total_order', 'complete_order', 'return_order', 'cancel_order', 'wishlists'));
    }

    public function customerInvoice(string $transaction_id)
    {
        $order_details = Order::where('transaction_id', $transaction_id)->first();
        $carts = Cart::where('order_id', $order_details->id)->where('user_id', Auth::id())->get() ;
        return view('frontend.pages.invoice.order-details-invoice', compact('order_details', 'carts'));
    }

}
