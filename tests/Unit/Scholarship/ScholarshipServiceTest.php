<?php

namespace Tests\Unit\Scholarship;

use App\Events\ScholarshipCreated;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use App\Services\Scholarships\Interfaces\CreatesScholarship;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class ScholarshipServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();
    }

    public function test_service_scholarship_can_be_created_with_valid_user_and_company()
    {
        Event::fake();

        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company)->save();

        $service = $this->app->make(CreatesScholarship::class);

        $scholarship = $service->create($company, [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);

        Event::assertDispatched(ScholarshipCreated::class);

        $this->assertDatabaseHas('scholarships', [
            'id' => $scholarship->id,
            'label' => $scholarship->label
        ]);
    }

    public function test_service_scholarship_created_with_invalid_attributes_throws_exception()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company)->save();

        $service = $this->app->make(CreatesScholarship::class);

        //TODO: Find out what error is being thrown

        $scholarship = $service->create($company, [
            'label' => null,
            'start_date' => null,
            'encoded_id' => null
        ]);

    }

    public function test_service_scholarship_created_without_company_throws_exception()
    {
    }
}
