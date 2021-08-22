<?php

namespace Tests\Feature\Scholarship;

use App\Models\Company;
use App\Models\Scholarship;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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

    public function test_a_user_can_view_their_related_scholarships()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
        $scholarship = Scholarship::factory()->create();

        $user->company()->associate($company)->save();
        $company->scholarships()->save($scholarship)->save();

        $user->fresh();

        $response = $this->actingAs($user)->get('/api/scholarships/' . $scholarship->id);

        $response->assertStatus(200);

        $response->assertJsonPath('data.id', $scholarship->id);
    }

    public function test_a_user_can_not_view_an_unrelated_scholarship()
    {
        $user = User::factory()->create();
        $company = Company::factory()->create();
    }
}
