<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Campaign;

class CampaignController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function manage()
    {
        $campaigns = Campaign::orderBy('id', 'asc')->where('status', 1)->get();
        return view('backend.pages.campaign.manage', compact('campaigns'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.pages.campaign.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $campaign = new Campaign();

        if( !is_null($campaign) ){

            $validated = $request->validate([
                'campaign_title'    => 'required|max:90',
                'start_date'        => 'required',
                'discount'          => 'required',
                'image'            => 'required',
            ]);

            $campaign->title         = $request->campaign_title;
            $campaign->start_date    = $request->start_date;
            $campaign->end_date      = $request->end_date;
            $campaign->discount      = $request->discount;
            $campaign->status        = $request->status;
            $campaign->month         = date('F');
            $campaign->year          = date('Y');

            // images
            if( $request->image ){
                $manager  =  new ImageManager(new Driver());
                $image    =  $request->image;
                $img      =  $manager->read($request->image);

                $images = $request->campaign_title . "-images-." . $image->getClientOriginalExtension();

                // images path location
                $location = public_path("backend/uploads/campaigns/" . $images);

                // images size set
                $img->resize(600, 400);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $campaign->image = $images;
            }

            // dd($campaign);
            $campaign->save();

        }

        $notifications = [
            "message"    => "Campaign data inserted successfully",
            'alert-type' => "success"
        ];

        return redirect()->route('campaign.manage')->with($notifications);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $campaign = Campaign::find($id);
        return view('backend.pages.campaign.edit', compact('campaign'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $campaign = Campaign::find($id);

        if( !is_null($campaign) ){

            $validated = $request->validate([
                'campaign_title'    => 'required|max:90',
                'start_date'        => 'required',
                'discount'          => 'required',
            ]);

            $campaign->title         = $request->campaign_title;
            $campaign->start_date    = $request->start_date;
            $campaign->end_date      = $request->end_date;
            $campaign->discount      = $request->discount;
            $campaign->status        = $request->status;

            // images
            if( $request->image ){

                if( file_exists("backend/uploads/campaigns/" . $campaign->image ) == ""){
                    unlink("backend/uploads/campaigns/" . $campaign->image );
                }
                else if( file_exists("backend/uploads/campaigns/" . $campaign->image ) ){
                    unlink("backend/uploads/campaigns/" . $campaign->image );
                }

                $manager  =  new ImageManager(new Driver());
                $image    =  $request->image;
                $img      =  $manager->read($request->image);

                $images = $request->campaign_title . "-images-." . $image->getClientOriginalExtension();

                // images path location
                $location = public_path("backend/uploads/campaigns/" . $images);

                // images size set
                $img->resize(600, 400);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $campaign->image = $images;
            }

            $campaign->save();
        }

        $notifications = [
            "message"    => "Campaign updated successfully",
            'alert-type' => "info"
        ];

        return redirect()->route('campaign.manage')->with($notifications);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $campaign = Campaign::find($id);

        if( !is_null($campaign) ){
            $campaign->status = 2;

            $campaign->save();

            $notifications = [
                "message"    => "Campaign data delete temporary",
                'alert-type' => "warning"
            ];

            return redirect()->back()->with($notifications);
        }
    }

    /**
     * Display the specified resource.
     */
    public function trashManage()
    {
        $campaigns = Campaign::orderBy('id', 'asc')->where('status', 2)->get();
        return view('backend.pages.campaign.trash', compact('campaigns'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function trashDestroy(string $id)
    {
        $campaign = Campaign::find($id);

        if( !is_null($campaign) ){
            unlink("backend/uploads/campaigns/" . $campaign->image);
            $campaign->delete();
        }

        $notifications = [
            "message"    => "Campaign Data delete permanently",
            'alert-type' => "error"
        ];

        return redirect()->back()->with($notifications);
    }
}
