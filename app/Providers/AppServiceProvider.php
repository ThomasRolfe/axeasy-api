<?php

namespace App\Providers;

use App\Services\Company\CompanyService;
use App\Services\Company\Interfaces\CreatesCompany;
use App\Services\Company\Interfaces\LinksUserToCompany;
use App\Services\Earnables\EarnableService;
use App\Services\Earnables\EarnableTargetService;
use App\Services\Earnables\Interfaces\CreatesEarnableTarget;
use App\Services\Earnables\Interfaces\GetsEarnable;
use App\Services\Scholarships\Interfaces\CreatesScholarship;
use App\Services\Scholarships\Interfaces\FindsScholarship;
use App\Services\Scholarships\Interfaces\GetsAllScholarships;
use App\Services\Scholarships\Interfaces\LinksCompanyToScholarship;
use App\Services\Scholarships\ScholarshipService;
use App\Services\Users\Interfaces\GetsAuthedUser;
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
        // Scholarships
        $this->app->bind(CreatesScholarship::class, ScholarshipService::class);
        $this->app->bind(FindsScholarship::class, ScholarshipService::class);
        $this->app->bind(GetsAllScholarships::class, ScholarshipService::class);
        $this->app->bind(LinksCompanyToScholarship::class, ScholarshipService::class);

        // Users
        $this->app->bind(GetsAuthedUser::class, UserService::class);

        // Companies
        $this->app->bind(CreatesCompany::class, CompanyService::class);
        $this->app->bind(LinksUserToCompany::class, CompanyService::class);

        // Earnables
        $this->app->bind(CreatesEarnableTarget::class, EarnableTargetService::class);
        $this->app->bind(GetsEarnable::class, EarnableService::class);
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
