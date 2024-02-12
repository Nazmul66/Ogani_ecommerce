<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\SMTP;
use App\Models\Setting;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;
use Illuminate\Support\Facades\File;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function seo_setting()
    {
        $seo = Seo::orderBy('id', 'asc')->first();
        return view('backend.pages.setting.seo', compact('seo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function seo_update(Request $request, string $id)
    {
        $seoSetting = Seo::find($id);

        if( !is_null($seoSetting) ){
            $seoSetting->meta_title            = $request->meta_title;
            $seoSetting->meta_author           = $request->meta_author;
            $seoSetting->meta_tag              = $request->meta_tag;
            $seoSetting->meta_description      = $request->meta_des;
            $seoSetting->meta_keyword          = $request->meta_keyword;
            $seoSetting->google_verification   = $request->google_verification;
            $seoSetting->google_analytics	   = $request->google_analytics;
            $seoSetting->alexa_verification	   = $request->alexa_verification;
            $seoSetting->google_adsense	       = $request->google_adsense;

            $seoSetting->save();

            $notifications = [
                "message"    => "SEO Setting Updated",
                'alert-type' => "info"
            ];
    
            return redirect()->route('seo.setting')->with($notifications);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function smtp_setting(Request $request)
    {
        $smtp = SMTP::orderBy('id', 'asc')->first();
        return view('backend.pages.setting.smtp', compact('smtp'));
    }

    /**
     * Display the specified resource.
     */
    public function smtp_update(Request $request, string $id)
    {
        $smtpSetting = SMTP::find($id);

        if( !is_null($smtpSetting) ){
            $smtpSetting->mailer           = $request->mail_mailer;
            $smtpSetting->host             = $request->mail_host;
            $smtpSetting->port             = $request->mail_port;
            $smtpSetting->user_name        = $request->user_name;
            $smtpSetting->password         = $request->mail_password;

            $smtpSetting->save();

            $notifications = [
                "message"    => "SMTP Setting Updated",
                'alert-type' => "info"
            ];
    
            return redirect()->route('smtp.setting')->with($notifications);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function website_setting()
    {
        $web_setting = Setting::orderBy('id', 'asc')->first();
        return view('backend.pages.setting.website_setting', compact('web_setting'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function website_update(Request $request, string $id)
    {
        $web_setting = Setting::find($id);

        if( !is_null( $web_setting ) ){
            $web_setting->currency        = $request->currency;
            $web_setting->phone_one       = $request->phone_one;
            $web_setting->phone_two       = $request->phone_two;
            $web_setting->mail_email      = $request->mail_email;
            $web_setting->support_email	  = $request->support_email;
            $web_setting->address         = $request->address;
            $web_setting->facebook        = $request->facebook;
            $web_setting->twitter         = $request->twitter;
            $web_setting->youtube         = $request->youtube;
            $web_setting->instagram       = $request->instagram;
            $web_setting->linkedin        = $request->linkedin;
    
            // for logo image
            if( $request->hasFile('logo') ){

                $old_logo_path = public_path("backend/uploads/website_setting/" . $web_setting->logo);
                if (File::exists($old_logo_path) && !File::isDirectory($old_logo_path)) {
                    unlink($old_logo_path);
                }

                $manager  =  new ImageManager(new Driver());
                $image    =  $request->logo;
                $img      =  $manager->read($request->logo);

                $images = rand(0, 9999999999) . "-setting-logo." . $image->getClientOriginalExtension();

                // images size set
                $img->resize(120, 80);

                // images path location
                $location = "backend/uploads/website_setting/" . $images;

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $web_setting->logo = $images;
            } 


            // for favicon image
            if( $request->hasFile('favicon') ){

                $old_fav_path = "backend/uploads/website_setting/" . $web_setting->favicon;
                if (File::exists($old_fav_path) && !File::isDirectory($old_fav_path)) {
                    unlink($old_fav_path);
                }

                $manager  =  new ImageManager(new Driver());
                $image    =  $request->favicon;
                $img      =  $manager->read($request->favicon);

                $images = rand(0, 9999999999) . "-setting-favicon." . $image->getClientOriginalExtension();

                // images size set
                $img->resize(120, 80);

                // images path location
                $location = public_path("backend/uploads/website_setting/" . $images);

                // to set images to their path location
                $img->toJpeg()->save($location);

                // added the images data to database
                $web_setting->favicon = $images;
            }
           

            $web_setting->save();

            $notifications = [
                "message"    => "Website setting updated successfully",
                'alert-type' => "success"
            ];
    
            return redirect()->route('website.setting')->with($notifications);

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
