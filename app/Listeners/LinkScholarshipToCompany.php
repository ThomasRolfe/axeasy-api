<?php

namespace App\Listeners;

use App\Events\ScholarshipCreated;
use App\Services\Scholarships\Interfaces\LinksCompanyToScholarship;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LinkScholarshipToCompany
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(protected LinksCompanyToScholarship $scholarshipService)
    {

    }

    /**
     * Handle the event.
     *
     * @param  ScholarshipCreated  $event
     * @return void
     */
    public function handle(ScholarshipCreated $event)
    {
        $this->scholarshipService->linkCompanyToScholarship($event->company, $event->scholarship);
    }
}
