<?php 

function getCartSummary() {
    $wishlist_count =  App\Models\Wishlist::where('user_id', Illuminate\Support\Facades\Auth::id() )->count();
    $cartLists  =  App\Models\Cart::where('user_id', Illuminate\Support\Facades\Auth::id() )->where('order_id', NULL)->get();


    // total item added into cart
    $total_item = 0;
    foreach ($cartLists as $cartList) {
        $total_item += $cartList->product_qty;
    }
    
    //total amount
    $total_amount = 0;
    foreach ($cartLists as $cartList) {
        $products   =  App\Models\Product::where('id', $cartList->product_id)->get();

        foreach ($products as $product) {
            if( $product->discount_price ){
                $total_amount += $cartList->product_qty * $product->discount_price;
            }
            else{
                $total_amount += $cartList->product_qty * $product->selling_price;
            }
        }
    }

    return [
        'total_item' => $total_item,
        'total_amount' => $total_amount,
        'wishlist_count' => $wishlist_count
    ];
}