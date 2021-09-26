<?php

namespace App\Providers;

use App\Repositories\Company\CompanyRepository;
use App\Repositories\Company\CompanyRepositoryInterface;
use App\Repositories\Earnable\EarnableRepository;
use App\Repositories\Earnable\EarnableRepositoryInterface;
use App\Repositories\EarnableTarget\EarnableTargetRepository;
use App\Repositories\EarnableTarget\EarnableTargetRepositoryInterface;
use App\Repositories\Scholarship\ScholarshipRepository;
use App\Repositories\Scholarship\ScholarshipRepositoryInterface;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(ScholarshipRepositoryInterface::class, ScholarshipRepository::class);
        $this->app->bind(CompanyRepositoryInterface::class, CompanyRepository::class);
        $this->app->bind(EarnableTargetRepositoryInterface::class, EarnableTargetRepository::class);
        $this->app->bind(EarnableRepositoryInterface::class, EarnableRepository::class);
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
