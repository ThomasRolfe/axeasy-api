<?php

namespace Tests\Unit\Scholarship;

use App\Exceptions\UserCompanyNotFoundException;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use App\Services\Scholarships\CreatesScholarship;
use App\Services\Scholarships\ScholarshipServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company)->save();

        $this->actingAs($user);

        $service = $this->app->make(CreatesScholarship::class);

        $scholarship = $service->create($company, [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);

        $this->assertDatabaseHas('scholarships', [
            'id' => $scholarship->id,
            'label' => $scholarship->label,
            'company_id' => $company->id
        ]);

        $this->assertTrue($scholarship->company->users->contains('id', $user->id));
    }

}
