<?php

namespace Tests\Unit\Scholarship;

use App\Exceptions\UserCompanyNotFoundException;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use App\Services\Scholarships\ScholarshipServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScholarshipServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected $scholarshipService;

    public function setUp(): void
    {
        parent::setUp();
        $this->scholarshipService = $this->app->make(ScholarshipServiceInterface::class);
    }

    public function test_service_scholarship_can_be_created_with_valid_user_and_company()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company)->save();

        $this->actingAs($user);

        $scholarship = $this->scholarshipService->create($user, [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'monthly_slp_target' => $this->faker->numberBetween(1000, 5000),
            'scholar_split' => ($this->faker->numberBetween(0, 100) / 100),
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);

        $this->assertDatabaseHas('scholarships', [
            'id' => $scholarship->id,
            'label' => $scholarship->label,
            'company_id' => $company->id
        ]);

        $this->assertTrue($scholarship->company->users->contains('id', $user->id));
    }

    public function test_service_user_can_not_create_scholarship_without_a_company()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $this->actingAs($user);

        $this->expectException(UserCompanyNotFoundException::class);

        $this->scholarshipService->create($user, [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'monthly_slp_target' => $this->faker->numberBetween(1000, 5000),
            'scholar_split' => ($this->faker->numberBetween(0, 100) / 100),
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);
    }
}
