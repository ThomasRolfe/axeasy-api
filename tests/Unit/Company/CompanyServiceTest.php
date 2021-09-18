<?php

namespace Tests\Unit\Company;

use App\Exceptions\UserCompanyAlreadyExistsException;
use App\Models\Company\Company;
use App\Models\Company\CompanyInterface;
use App\Models\User\User;
use App\Services\Company\CompanyServiceInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_service_company_can_be_created()
    {
        $user = User::factory()->create();
        $companyService = $this->app->make(CompanyServiceInterface::class);

        $data = ['label' => $this->faker->company];

        $company = $companyService->create($user, $data);

        $this->assertInstanceOf(CompanyInterface::class, $company);
        $this->assertEquals($data['label'], $company->label);
    }

    public function test_service_user_with_company_cannot_create_company()
    {
        $companyService = $this->app->make(CompanyServiceInterface::class);

        $user = User::factory()->create();
        $company = Company::factory()->create();
        $user->company()->associate($company);

        $this->expectException(UserCompanyAlreadyExistsException::class);

        $companyService->create($user, ['label' => $this->faker->company]);
    }

    public function test_service_user_is_linked_to_created_company()
    {
        $companyService = $this->app->make(CompanyServiceInterface::class);

        $user = User::factory()->create();

        $data = ['label' => $this->faker->company];

        $companyService->create($user, $data);

        $user = $user->fresh();

        dump($user->company);
        $this->assertNotNull($user->company);
        $this->assertEquals($data['label'], $user->company->label);
    }
}
