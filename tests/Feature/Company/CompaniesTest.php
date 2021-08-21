<?php

namespace Tests\Feature\Company;

use App\Models\Company;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class CompaniesTest extends TestCase
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

    public function test_company_is_not_linked_when_user_is_created()
    {
        $user = User::factory()->create();
        $this->assertNull($user->company);
    }

    public function test_linked_company_can_be_accessed_from_user()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $user->company()->associate($company)->save();

        $user->fresh();

        $this->assertTrue($user->company->is($company));
    }

    public function test_company_returned_with_user_on_user_endpoint()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();

        $user->company()->associate($company)->save();
        $user->fresh();

        $response = $this->actingAs($user)->get('/api/user');

        $response->assertStatus(200);

        $response->assertJsonPath('company.label', $company->label);
    }

}
