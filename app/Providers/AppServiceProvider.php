<?php

namespace App\Providers;

use App\Services\Company\CompanyService;
use App\Services\Company\CompanyServiceInterface;
use App\Services\Scholarships\Interfaces\CreatesScholarship;
use App\Services\Scholarships\Interfaces\FindsScholarship;
use App\Services\Scholarships\Interfaces\GetsAllScholarships;
use App\Services\Scholarships\Interfaces\LinksCompanyToScholarship;
use App\Services\Scholarships\ScholarshipService;
use App\Services\Users\GetsAuthedUser;
use App\Services\Users\UserService;
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
        $this->app->bind(CreatesScholarship::class, ScholarshipService::class);
        $this->app->bind(FindsScholarship::class, ScholarshipService::class);
        $this->app->bind(GetsAllScholarships::class, ScholarshipService::class);
        $this->app->bind(LinksCompanyToScholarship::class, ScholarshipService::class);

        $this->app->bind(GetsAuthedUser::class, UserService::class);
        
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
