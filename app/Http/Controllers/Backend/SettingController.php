<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Seo;
use App\Models\SMTP;

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
