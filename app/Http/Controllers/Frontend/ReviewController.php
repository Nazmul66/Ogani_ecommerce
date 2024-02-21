<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            "message"    => "Review inserted! Successfully",
            'alert-type' => "success"
        ];

        return redirect()->back()->with($notifications);
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
