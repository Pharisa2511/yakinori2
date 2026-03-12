<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Cache; // <--- เพิ่มบรรทัดนี้ครับ

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
        // แชร์ตัวแปร $categories ให้ทุกหน้าเว็บที่ใช้ layouts.main
        View::composer('layouts.main', function ($view) {
            $categories = Cache::remember('categories_menu', 3600, function () {
                return Category::all();
            });
            $view->with('categories', Category::all());
        });
    }
}
