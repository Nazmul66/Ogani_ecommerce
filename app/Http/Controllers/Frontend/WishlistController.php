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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
