<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Setting;
use App\Models\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $settings =  Setting::orderBy('id', 'asc')->first();
        view()->share('setting', $settings);

        $pages = Page::orderBy("id", "asc")->get();
        view()->share("pages", $pages);
    }
}
