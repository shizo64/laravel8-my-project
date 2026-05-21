<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Place;
use App\Models\Category;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        view()->composer('includes.admin.sidebar', function ($view) {
            $view->with('placeCount', Place::count());
            $view->with('categoryCount', Category::count());
        });
    }
}
