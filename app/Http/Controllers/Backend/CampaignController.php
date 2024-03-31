<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use App\Models\Campaign;
use App\Models\Campaign_product;
use App\Models\Product;
use App\Models\SubCategory;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Support\Facades\DB;

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


    public function campaignProduct(string $campaign_id)
    {
        $products = DB::table('products')->leftJoin('categories', 'products.category_id', 'categories.id')
                ->leftJoin('sub_categories', 'products.subCategory_id', 'sub_categories.id')
                ->leftJoin('brands', 'products.brand_id', 'brands.id')
                ->select('products.*', 'categories.category_name', 'sub_categories.subcategory_name', 'brands.brand_name')
                ->where('products.status', 1)
                // ->where('products.discount_price', NULL)
                // ->whereNotNull('products.selling_price')
                ->get();

        return view('backend.pages.campaign_product.manage', compact('products', 'campaign_id'));
    }

    public function productAddToCampaign(string $id, $campaign_id)
    {
        $campaign = Campaign::where('id', $campaign_id)->first();
        $product  = Product::where('id', $id)->first();

        $discount_amount = $product->selling_price * $campaign->discount / 100;
        $discount_price  = $product->selling_price - $discount_amount;
        // echo $discount_price;

        $campaign_product = new Campaign_product();

        if( !is_null($campaign_product) ){
            $campaign_product->campaign_id    = $campaign_id;
            $campaign_product->product_id     = $id;
            $campaign_product->price          = $discount_price;

            $campaign_product->save();

            $notifications = [
                "message"    => "Product campaign Data inserted",
                'alert-type' => "success"
            ];
    
            return redirect()->back()->with($notifications);
        }
    }

    public function campaignProductList(string $campaign_id)
    {
        $products = DB::table('campaign_products')->leftJoin('products', 'products.id', 'campaign_products.product_id')
                    ->select('campaign_products.*', 'products.thumbnail', 'products.product_name', 'products.product_code', 'products.selling_price')
                    ->where('campaign_products.campaign_id', $campaign_id)
                    ->get();

        return view('backend.pages.campaign_product.campaignList-manage', compact('products', 'campaign_id'));
    }

    public function destroyCampaignProduct(string $id)
    {
        $campaign_product = Campaign_product::find($id);

        if( !is_null( $campaign_product ) ){
            $campaign_product->delete();

            $notifications = [
                "message"    => "campaign data delete successfully",
                'alert-type' => "error"
            ];
    
            return redirect()->back()->with($notifications);
        }
    }
}
