<?php

namespace Tests\Feature\Scholarship;

use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\ScholarshipInterface;
use App\Models\User\UserInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ScholarshipEndpointTest extends TestCase
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

    public function test_endpoint_user_can_view_their_related_scholarship_by_id()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $scholarship = $this->app->make(ScholarshipInterface::class)::factory()->create();

        $user->company()->associate($company)->save();
        $company->scholarships()->save($scholarship)->save();
        $user->fresh();

        $response = $this->actingAs($user)
            ->get('/api/scholarships/' . $scholarship->id);

        $response->assertStatus(200);

        $response->assertJsonPath('data.id', $scholarship->id);
    }

    public function test_endpoint_user_can_view_an_index_of_their_related_scholarships()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $scholarships = $this->app->make(ScholarshipInterface::class)::factory()->count(5)->make();

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
                    'encoded_id',
                    'id',
                    'created_at',
                    'updated_at'
                ]
            ]
        ]);
    }

    public function test_endpoint_user_can_not_view_an_unrelated_scholarship()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $scholarship = $this->app->make(ScholarshipInterface::class)::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $response = $this->actingAs($user)
            ->get('/api/scholarship/' . $scholarship->id);

        $response->assertStatus(404);
    }

    public function test_endpoint_user_with_no_scholarships_gets_empty_array()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company)->save();
        $user->fresh();

        $response = $this->actingAs($user)
            ->get('/api/scholarships');

        $response->assertStatus(200);
        $response->assertJson([
            'data' => [],
            'count' => 0
        ]);
    }

    public function test_endpoint_user_can_create_scholarship()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $data = [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ];

        $response = $this->actingAs($user)
            ->post('/api/scholarships/', $data);

        $response->assertStatus(201);

        $response->assertJsonPath('data.label', $data['label']);
        $response->assertJsonPath('data.start_date', $data['start_date']);

        $this->assertDatabaseHas('scholarships', [
            'label' => $data['label']
        ]);
    }

    public function test_endpoint_user_cannot_create_a_scholarship_without_a_company()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();

        $data = [
            'label' => $this->faker->name,
            'start_date' => $this->faker->date,
            'encoded_id' => base_convert($this->faker->numberBetween(100, 10000), 10, 32)
        ];

        $response = $this->actingAs($user)
            ->post('/api/scholarships/', $data);

        $response->assertStatus(403);
    }

    // TODO: change this name to validation errors
    public function test_endpoint_scholarship_cannot_be_created_with_invalid_attributes()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $data = [
            'wrong_value_1' => '',
            'start_date' => 'some text not a date'
        ];

        $response = $this->actingAs($user)
            ->post('/api/scholarships/', $data);

        $response->assertStatus(422);

        $response->assertJsonValidationErrors(['label', 'start_date',]);
    }
}
