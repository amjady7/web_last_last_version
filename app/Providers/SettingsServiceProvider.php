<?php

namespace App\Providers;

use App\Models\Setting;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class SettingsServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        try {
            if (Schema::hasTable('settings')) {
                $settings = Setting::first();
                if ($settings) {
                    view()->share('settings', $settings);
                }
            }
        } catch (\Exception $e) {
            // Handle the case when the settings table doesn't exist yet
            // or when there are database connection issues
        }
    }
} 