<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Visitor as Visitor;
use App\Category as Category;

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
        // Share browsers unique visitors for the today (by default)
        \View::share('visitors', Visitor::unique(new \DateTime));

        // Share blog categories
        \View::share('categories', Category::orderBy('name', 'asc')->get());
    }
}
