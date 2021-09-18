<?php

namespace App\Listeners;

use App\Events\ScholarshipCreated;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class LinkScholarshipToCompany
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  ScholarshipCreated  $event
     * @return void
     */
    public function handle(ScholarshipCreated $event)
    {
        $event->company->scholarships()->save($event->scholarship);
    }
}
