<?php

namespace App\Providers;

use App\Events\CompanyCreated;
use App\Events\ScholarshipCreated;
use App\Listeners\LinkScholarshipToCompany;
use App\Listeners\LinkUserToCompany;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        CompanyCreated::class => [
            LinkUserToCompany::class
        ],
        ScholarshipCreated::class => [
            LinkScholarshipToCompany::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
