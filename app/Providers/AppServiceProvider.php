<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ProductVideo;

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
        View::composer(['home', 'opero', 'itikia', 'solutions.*', 'admin.dashboard'], function ($view) {
            $view->with('productVideos', ProductVideo::allAsMap());
        });

        View::composer('*', function ($view) {
            static $contactSettings = null;
            if ($contactSettings === null) {
                try {
                    $contactSettings = \App\Models\ContactSetting::first();
                } catch (\Throwable $e) {
                    $contactSettings = null;
                }
            }
            $view->with('contactSettings', $contactSettings);
        });
    }
}
