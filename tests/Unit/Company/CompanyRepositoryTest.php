<?php

namespace Tests\Unit\Company;

use App\Models\Company\Company;
use App\Models\Company\CompanyInterface;
use App\Repositories\Company\CompanyRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CompanyRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_repository_can_create_company()
    {
        $repository = $this->app->make(CompanyRepositoryInterface::class);

        $data = ['label' => $this->faker->company];

        $company = $repository->create($data);

        $this->assertInstanceOf(CompanyInterface::class, $company);
        $this->assertEquals($data['label'], $company->label);
    }

    public function test_repository_can_find_company_by_id()
    {
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $repository = $this->app->make(CompanyRepositoryInterface::class);

        $loadedCompany = $repository->find($company->id);

        $this->assertTrue($company->is($loadedCompany));

    }

    public function test_repository_can_list_all_companies()
    {
        $companies = $this->app->make(CompanyInterface::class)::factory()->count(5)->create();
        $repository = $this->app->make(CompanyRepositoryInterface::class);

    }
}
