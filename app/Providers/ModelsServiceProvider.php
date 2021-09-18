<?php

namespace App\Providers;

use App\Models\Company\Company;
use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\Scholarship;
use App\Models\Scholarship\ScholarshipInterface;
use App\Models\User\User;
use App\Models\User\UserInterface;
use Illuminate\Support\ServiceProvider;

class ModelsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserInterface::class, User::class);
        $this->app->bind(ScholarshipInterface::class, Scholarship::class);
        $this->app->bind(CompanyInterface::class, Company::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
