<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Categories;

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
        // View composer untuk mengirim variabel $categories ke view tertentu
        View::composer(['web.categories', 'dashboard.categories.index'], function ($view) {
            $categories = Categories::latest()->paginate(20);
            $view->with('categories', $categories);
        });
    }
}
