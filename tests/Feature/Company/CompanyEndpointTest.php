<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\Company\CompanyInterface;
use App\Models\Scholarship\ScholarshipInterface;
use App\Models\User\UserInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyEndpointTest extends TestCase
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

    public function test_endpoint_user_without_company_can_create_company()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $data = ['label' => $this->faker->company];

        $response = $this->actingAs($user)->post('/api/companies', $data);

        $response->assertStatus(201);
        $this->assertEquals($data['label'], $user->company->label);
    }

    public function test_endpoint_company_cannot_be_created_with_missing_attributes()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $data = [];

        $response = $this->actingAs($user)->post('/api/companies', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['label']);
    }

    public function test_endpoint_company_cannot_be_created_with_invalid_attributes()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $data = ['label' => null];

        $response = $this->actingAs($user)->post('/api/companies', $data);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors(['label']);
    }

    public function test_endpoint_user_with_company_can_not_create_company()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company)->save();

        $data = ['label' => $this->faker->company];

        $response = $this->actingAs($user)->post('/api/companies', $data);

        $response->assertStatus(403);
    }

    public function test_endpoint_company_cannot_be_created_without_user()
    {
        $data = ['label' => $this->faker->company];

        $response = $this->post('/api/companies', $data);

        $response->assertStatus(401);
        $response->assertSee('Unauthenticated');
    }


}
