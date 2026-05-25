<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use App\Models\User;
use App\Models\Announcement;

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
        /**
         * 1. Super Admin Bypass
         * Jika user memiliki role 'super-admin', izinkan akses ke semua Gate/Permission
         * tanpa perlu mendefinisikan permission satu per satu secara manual.
         */
        Gate::before(function ($user, $ability) {
            // Cek method hasRole tersedia (dari package Spatie)
            if (method_exists($user, 'hasRole')) {
                return $user->hasRole('super-admin') ? true : null;
            }
            return null;
        });

        /**
         * 2. View Composer untuk Announcement Banner
         * Mengambil data announcement aktif dan membagikannya ke layout master.
         * Menggunakan View Composer mencegah query database ditulis langsung di file Blade.
         */
        View::composer('layouts.app', function ($view) {
            $activeAnnouncement = Announcement::where('is_active', true)
                ->where(function($q) { 
                    $q->whereNull('mulai_tampil')->orWhere('mulai_tampil', '<=', now()); 
                })
                ->where(function($q) { 
                    $q->whereNull('selesai_tampil')->orWhere('selesai_tampil', '>=', now()); 
                })
                ->orderBy('urutan')
                ->first();

            $view->with('activeAnnouncement', $activeAnnouncement);
        });
    }
}