<?php

namespace Tests\Unit\Company;

use App\Events\CompanyCreated;
use App\Exceptions\UserCompanyAlreadyExists;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use App\Services\Company\Interfaces\CreatesCompany;
use App\Services\Company\Interfaces\LinksUserToCompany;
use Illuminate\Database\QueryException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Event;
use Tests\TestCase;

class CompanyServiceTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_service_company_can_be_created()
    {
        Event::fake();
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $companyService = $this->app->make(CreatesCompany::class);

        $data = ['label' => $this->faker->company];

        $company = $companyService->create($user, $data);

        $this->assertInstanceOf(CompanyInterface::class, $company);
        $this->assertEquals($data['label'], $company->label);
        Event::assertDispatched(CompanyCreated::class);
    }

    public function test_service_user_with_company_cannot_create_company()
    {
        $companyService = $this->app->make(CreatesCompany::class);

        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user->company()->associate($company);

        $this->expectException(UserCompanyAlreadyExists::class);

        $companyService->create($user, ['label' => $this->faker->company]);
    }

    public function test_service_user_is_linked_to_created_company()
    {
        $companyService = $this->app->make(CreatesCompany::class);

        $user = $this->app->make(UserInterface::class)::factory()->create();

        $data = ['label' => $this->faker->company];

        $companyService->create($user, $data);

        $user = $user->fresh();

        $this->assertNotNull($user->company);
        $this->assertEquals($data['label'], $user->company->label);
    }

    public function test_service_company_cannot_be_created_with_missing_required_attributes()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $companyService = $this->app->make(CreatesCompany::class);

        $data = [];

        $this->expectException(QueryException::class);

        $companyService->create($user, $data);
    }

    public function test_service_user_can_be_linked_to_company()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $linksCompanyService = $this->app->make(LinksUserToCompany::class);

        $linksCompanyService->linkUserToCompany($user, $company);

        $user->fresh();

        $this->assertEquals($company->label, $user->company->label);
    }

    public function test_service_user_cannot_be_linked_to_company_when_already_linked()
    {
        $user = $this->app->make(UserInterface::class)::factory()->create();
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $newCompany = $this->app->make(CompanyInterface::class)::factory()->create();
        $linksCompanyService = $this->app->make(LinksUserToCompany::class);

        $user->company()->associate($company)->fresh();

        $this->expectException(UserCompanyAlreadyExists::class);

        $linksCompanyService->linkUserToCompany($user, $newCompany);
    }
}
