<?php

namespace Tests\Unit\Scholarship;

use App\Repositories\Scholarship\ScholarshipRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ScholarshipRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_scholarship_can_be_created_from_repository()
    {
        $scholarshipRepository = $this->app->make(ScholarshipRepositoryInterface::class);

        $scholarship = $scholarshipRepository->create([
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);

        $this->assertDatabaseHas('scholarships', [
            'label' => $scholarship->label,
            'id' => $scholarship->id
        ]);
    }
}
