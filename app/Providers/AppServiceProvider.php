<?php

namespace App\Providers;

use App\Models\SiteSetting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;

use Throwable;

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
        $siteLogoUrl = asset('images/logo.png');
        $footerData = SiteSetting::getFooterDefaults();

        try {
            if (Schema::hasTable('site_settings')) {
                $path = SiteSetting::getValue('school_logo');
                $footerData = SiteSetting::getFooterData();

                if ($path) {
                    $siteLogoUrl = Storage::url($path);
                }
            }
        } catch (Throwable $e) {
            // Keep default logo during early boot / migrations.
        }

        View::share('siteLogoUrl', $siteLogoUrl);
        View::share('footerData', $footerData);
    }
}
