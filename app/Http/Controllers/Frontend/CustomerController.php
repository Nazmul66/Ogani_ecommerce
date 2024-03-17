<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Wishlist;
use App\Models\User;
use App\Models\Ticket;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function customerProfile()
    {
        $usersData = User::where("id", Auth::user()->id)->first();
        return view('frontend.pages.users.customer-profile', compact('usersData'));
    }

    public function customerInvoice(string $transaction_id)
    {
        $order_details = Order::where('transaction_id', $transaction_id)->first();
        $carts = Cart::where('order_id', $order_details->id)->where('user_id', Auth::id())->get() ;
        return view('frontend.pages.invoice.order-details-invoice', compact('order_details', 'carts'));
    }

    public function customerDashboard()
    {
        $orders          = Order::where("user_id", Auth::id())->get();
        $wishlists       = Wishlist::where('user_id', Auth::id())->get();
        $total_order     = Order::where("user_id", Auth::id())->count();
        $complete_order  = Order::where("user_id", Auth::id())->where('status', 3)->count();
        $return_order    = Order::where("user_id", Auth::id())->where('status', 4)->count();
        $cancel_order    = Order::where("user_id", Auth::id())->where('status', 5)->count();
        $tickets         = Ticket::where('user_id', Auth::id())->latest()->take(10)->get();
        return view('frontend.pages.users.customer-dashboard', compact('orders', 'total_order', 'complete_order', 'return_order', 'cancel_order', 'wishlists', 'tickets'));
    }

    public function userInfo(Request $request, string $id)
    {
       $userInfo = User::find($id);

       if( !is_null($userInfo) ){
          $userInfo->name     = $request->name;
          $userInfo->email    = $request->email;
          $userInfo->phone    = $request->phone;

          if( $request->image ){
            
                if (!empty($userInfo->image)) {
                    if( file_exists("frontend/img/customer-images/" . $userInfo->image ) == ""){
                        unlink("frontend/img/customer-images/" . $userInfo->image );
                    }
                    else if( file_exists("frontend/img/customer-images/" . $userInfo->image ) ){
                        unlink("frontend/img/customer-images/" . $userInfo->image );
                    }
                }

            $manager  =  new ImageManager(new Driver());
            $image    =  $request->image;
            $img      =  $manager->read($request->image);

            $images = $request->name . "-." . $image->getClientOriginalExtension();

            // images path location
            $location = public_path("frontend/img/customer-images/" . $images);

            // images size set
            $img->resize(600, 600);

            // to set images to their path location
            $img->toJpeg()->save($location);

            // added the images data to database
            $userInfo->image = $images;
            $userInfo->save();
        }

          $userInfo->save();
       }

       $notifications = [
        "message"    => "Customer profile has been updated",
        'alert-type' => "info",
        ];

       return redirect()->back()->with($notifications);
    }


    public function userShippingInfo(Request $request, string $id)
    {
        $userInfo = User::find($id);

        if( !is_null($userInfo) ){
           $userInfo->address_Line1    = $request->address_Line1;
           $userInfo->address_Line2    = $request->address_Line2;
           $userInfo->division_id      = $request->division_id;
           $userInfo->district_id      = $request->district_id;
           $userInfo->country_id       = $request->city_id;
           $userInfo->zipCode          = $request->zipCode;
        }

        $userInfo->save();
 
        $notifications = [
         "message"    => "Customer profile has been updated",
         'alert-type' => "info",
         ];
 
        return redirect()->back()->with($notifications);
    }

    public function storeTicket(Request $request)
    {
       $ticket = new Ticket();

       if( !is_null($ticket) ){
          $ticket->user_id   = Auth::id();
          $ticket->subject   = $request->subject;
          $ticket->service   = $request->service;
          $ticket->priority  = $request->priority;
          $ticket->message   = $request->message;
          $ticket->status    = 0;
          $ticket->date      = date('Y-m-d');

          if( $request->image ){
                $manager  =  new ImageManager(new Driver());
                $image    =  $request->image;
                $img      =  $manager->read($request->image);

                $images = rand(0, 9999999) . "-ticket-image." . $image->getClientOriginalExtension();

                // images path location
                $location = public_path("frontend/img/ticket/" . $images);

                // images size set
                $img->resize(240, 120);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                // $product->thumbnail = $images;
                $ticket->image   =  $images;
          }

            $ticket->save();
 
            $notifications = [
            "message"    => "Support ticket is being sent",
            'alert-type' => "info",
            ];
    
            return redirect()->back()->with($notifications);
       }
    }
}
