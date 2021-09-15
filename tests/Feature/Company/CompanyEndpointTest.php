<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\User;
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

    public function test_company_returned_with_user_on_user_endpoint()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $response = $this->actingAs($user)->get('/api/user');

        $response->assertStatus(200);

        $response->assertJsonPath('data.company.label', $company->label);
    }
}
