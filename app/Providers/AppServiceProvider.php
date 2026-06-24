<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

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
        view()->composer('*', function ($view) {
            $logoSetting = null;
            try {
                if (\Illuminate\Support\Facades\Schema::hasTable('settings')) {
                    $logoSetting = \App\Models\Setting::where('key', 'site_logo')->first();
                }
            } catch (\Exception $e) {}

            $global_site_logo = $logoSetting && $logoSetting->value 
                ? asset('storage/' . $logoSetting->value) 
                : asset('images/logo-ugk-dummy.svg');
                
            $view->with('global_site_logo', $global_site_logo);
        });
    }
}
