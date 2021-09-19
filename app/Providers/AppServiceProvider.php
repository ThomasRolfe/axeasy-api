<?php

namespace App\Providers;

use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Scholarships\CreatesScholarship;
use App\Services\Scholarships\ScholarshipService;
use App\Services\Scholarships\ScholarshipServiceInterface;
use App\Services\Users\UserService;
use App\Services\Users\UserServiceInterface;
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
        $this->app->bind(CreatesScholarship::class, ScholarshipService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(CompanyServiceInterface::class, CompanyService::class);
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
