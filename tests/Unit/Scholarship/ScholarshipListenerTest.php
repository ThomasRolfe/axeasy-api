<?php

namespace Tests\Unit\Scholarship;

use App\Events\ScholarshipCreated;
use App\Listeners\LinkScholarshipToCompany;
use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\ScholarshipInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ScholarshipListenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_listener_link_scholarship_to_company()
    {
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $scholarship = $this->app->make(ScholarshipInterface::class)::factory()->create();

        $listener = $this->app->make(LinkScholarshipToCompany::class);

        $listener->handle(
            new ScholarshipCreated($company, $scholarship)
        );

        $scholarship->fresh();

        $this->assertEquals($company->id, $scholarship->company->id);
    }
}
