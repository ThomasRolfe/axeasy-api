<?php

namespace App\Providers;

use App\Services\Scholarships\ScholarshipService;
use App\Services\Scholarships\ScholarshipServiceInterface;
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
        $this->app->bind(ScholarshipServiceInterface::class, ScholarshipService::class);
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
