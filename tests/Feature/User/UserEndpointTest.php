<?php

namespace Tests\Feature\User;

use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserEndpointTest extends TestCase
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

    public function test_endpoint_company_returned_with_user()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $response = $this->actingAs($user)->get('/api/user');

        $response->assertStatus(200);

        $response->assertJsonPath('data.company.label', $company->label);
    }
}
