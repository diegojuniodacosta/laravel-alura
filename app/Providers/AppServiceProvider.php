<?php

namespace App\Providers;

use App\Models\Series;
use App\Observers\SeriesCreatedObserver;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(): void
    {
        Series::observe(SeriesCreatedObserver::class);
    }
}
