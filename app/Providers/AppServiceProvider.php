<?php

namespace App\Providers;

use App\Models\Admin;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;
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
        //
        Schema::defaultStringLength(191);
        if (!app()->runningInConsole()) {
            $setting = Setting::firstOr(function () {
                return Setting::create([
                    'name' => 'site_name',
                    'description' => 'Laravel'
                ]);
            });
            view()->share('setting', $setting);
        }

        if (!app()->runningInConsole()) {
            $admin = Admin::firstOr(function () {
                return Admin::create([
                    'name' => 'Mohammed Sharaf',
                    'email' => 'moh@gmail.com',
                    // 'password' => Hash::make(123),
                    'password' => bcrypt(123),
                    'email_verified_at' => now(),
                ]);
            });
            view()->share('admin', $admin);
        }
        // if (!app()->runningInConsole()) {
        //     $user = User::firstOr(function () {
        //         return User::create([
        //             'name' => 'Abed Sharaf',
        //             'email' => 'abd@gmail.com',
        //             // 'password' => Hash::make(123),
        //             'password' => bcrypt(123),
        //             'email_verified_at' => now(),
        //         ]);
        //     });
        //     view()->share('user', $user);
        // }

        Paginator::useBootstrap();
    }
}
