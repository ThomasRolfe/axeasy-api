<?php

namespace Tests\Unit\Scholarship;

use App\Models\Company;
use App\Models\User;
use App\Repositories\ScholarshipRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScholarshipCreationTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_scholarship_can_be_created_from_repository()
    {
        $scholarshipRepository = new ScholarshipRepository();

        $scholarship = $scholarshipRepository->create([
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'monthly_slp_target' => $this->faker->numberBetween(1000, 5000),
            'scholar_split' => ($this->faker->numberBetween(0, 100) / 100),
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);

        $this->assertDatabaseHas('scholarships', [
            'label' => $scholarship->label,
            'id' => $scholarship->id
        ]);
    }


}
