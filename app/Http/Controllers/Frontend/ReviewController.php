<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\WbReview;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function storeReview(Request $request)
    {
        $reviews = new Review();

        if( !is_null($reviews) ){
            $reviews->user_id          =  Auth::user()->id;
            $reviews->product_id       =  $request->product_id;
            $reviews->review           =  $request->review;
            $reviews->rating           =  $request->rating_star;
            $reviews->review_date      =  date('d-m-Y');
            $reviews->review_month     =  date('F');
            $reviews->review_year      =  date('Y');
        }

        $reviews->save();

        $notifications = [
            "message"    => "Thanks for your review",
            'alert-type' => "success"
        ];

        return redirect()->back()->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function writeReview(Request $request)
    {
        $check = WbReview::where('user_id', Auth::user()->id)->first();
        if( $check ){
            $notifications = [
                "message"    => "Review already exist!",
                'alert-type' => "error"
            ];
    
            return redirect()->back()->with($notifications);
        }
        
        else{
            $website_review = new WbReview();

            if( !is_null($website_review) ){
                $website_review->user_id        = Auth::user()->id; 
                $website_review->name           = $request->name; 
                $website_review->review         = $request->review; 
                $website_review->rating         = $request->rating; 
                $website_review->review_date    = date('d-m-y'); 
                $website_review->status         = 2; 
    
                $website_review->save();
    
                $notifications = [
                    "message"    => "Website review inserted! Successfully",
                    'alert-type' => "success"
                ];
        
                return redirect()->back()->with($notifications);
            }
        }

    }
}
