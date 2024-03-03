<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function addWishlist(string $id)
    {
        if( !Auth::check() ){
            return redirect()->route('login');
        }
        else{
            $wishlist_check = Wishlist::where('user_id', Auth::user()->id)->where('product_id', $id)->first();

            if( $wishlist_check ){

                $wishlist_check->delete();

                $notifications = [
                    "message"    => "Product removed on wishlist",
                    'alert-type' => "error",
                ];
        
                return redirect()->back()->with($notifications);
            }
            else{
                $wishlist = new Wishlist();

                if( !is_null($wishlist) ){
                    $wishlist->user_id    =  Auth::user()->id;
                    $wishlist->product_id =  $id;
                    $wishlist->date       =  date('d, F y');
                }

                $wishlist->save();

                $notifications = [
                    "message"    => "Product added on wishlist",
                    'alert-type' => "success",
                ];
        
                return redirect()->back()->with($notifications);
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function wishlist()
    {
        if( !Auth::check() ){
            $notifications = [
                "message"    => "At first please login your account",
                'alert-type' => "warning",
            ];

           return redirect()->route('login')->with($notifications);
        }

        else{
           $wishlists = Wishlist::where('user_id', Auth::id())->get();
           return view('frontend.pages.cart.wishlist', compact('wishlists'));
        }
    }

    public function clearWishlist()
    {
        $wishlists = Wishlist::where('user_id', Auth::id())->delete();

        if( !is_null($wishlists)){
            $notifications = [
                "message"    => "Clear All Wishlists data",
                'alert-type' => "warning",
            ];
    
           return redirect()->back()->with($notifications);
        }
    }

    public function destroy(string $id)
    {
        $wishlist = Wishlist::where('id', $id)->delete();

        if( !is_null($wishlist)){
            $notifications = [
                "message"    => "Wishlists data is being delete",
                'alert-type' => "error",
            ];
    
           return redirect()->back()->with($notifications);
        }
    }
}
