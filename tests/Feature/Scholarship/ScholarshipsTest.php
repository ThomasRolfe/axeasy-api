<?php

namespace Tests\Feature\Scholarship;

use App\Exceptions\UserCompanyNotFoundException;
use App\Models\Company;
use App\Models\Scholarship;
use App\Models\User;
use App\Services\Scholarships\ScholarshipService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ScholarshipsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function setUp(): void
    {
        parent::setUp();

        $this->withHeaders([
            'Origin' => 'localhost',
            'Referer' => 'localhost',
            'Accept' => 'application/json'
        ]);
    }

    public function test_user_can_view_their_related_scholarship_by_id()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $scholarship = Scholarship::factory()->create();

        $user->company()->associate($company)->save();
        $company->scholarships()->save($scholarship)->save();
        $user->fresh();

        $response = $this->actingAs($user)
            ->get('/api/scholarships/' . $scholarship->id);

        $response->assertStatus(200);

        $response->assertJsonPath('data.id', $scholarship->id);
    }

    public function test_user_can_view_an_index_of_their_related_scholarships()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $scholarships = Scholarship::factory()->count(5)->make();

        $user->company()->associate($company)->save();
        $company->scholarships()->saveMany($scholarships);
        $user->fresh();

        $response = $this->actingAs($user)
            ->get('/api/scholarships');

        $response->assertStatus(200);

        $response->assertJson(function (AssertableJson $json) use ($scholarships) {
            $json->has('count')
                ->has('data', 5)
                ->has('data.0', function (AssertableJson $json) use ($scholarships) {
                    $json->where('label', $scholarships[0]->label)
                        ->etc();
                });
        });

        $response->assertJsonStructure([
            'count',
            'data' => [
                '*' => [
                    'label',
                    'start_date',
                    'monthly_slp_target',
                    'scholar_split',
                    'encoded_id',
                    'id',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }

    public function test_user_can_not_view_an_unrelated_scholarship()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $scholarship = Scholarship::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $response = $this->actingAs($user)
            ->get('/api/scholarship/' . $scholarship->id);

        $response->assertStatus(404);
    }

    public function test_user_with_no_scholarships_gets_empty_array()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)
            ->get('/api/scholarships');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [],
            'count' => 0
        ]);
    }

    public function test_scholarship_can_be_created_from_service_with_valid_user_and_company()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $user->company()->associate($company)->save();

        $this->actingAs($user);

        $scholarshipService = $this->app->make(ScholarshipService::class);

        $scholarship = $scholarshipService->createScholarship([
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

    public function test_user_can_not_create_scholarship_without_a_company()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $scholarshipService = $this->app->make(ScholarshipService::class);

        $this->expectException(UserCompanyNotFoundException::class);

        $scholarshipService->createScholarship([
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'monthly_slp_target' => $this->faker->numberBetween(1000, 5000),
            'scholar_split' => ($this->faker->numberBetween(0, 100) / 100),
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ]);
    }

    public function test_user_can_create_scholarship_through_endpoint()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $scholarship = Scholarship::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $data = [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'monthly_slp_target' => $this->faker->numberBetween(1000, 5000),
            'scholar_split' => ($this->faker->numberBetween(0, 100) / 100),
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ];

        $response = $this->actingAs($user)
            ->post('/api/scholarships/', $data);

        $response->assertStatus(201);

        $response->assertJsonPath('data.label', $data['label']);
        $response->assertJsonPath('data.start_date', $data['start_date']);

        $this->assertDatabaseHas('scholarships', [
            'id' => $data['id'],
            'label' => $data['label']
        ]);
    }
}
