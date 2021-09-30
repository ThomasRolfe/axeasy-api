<?php

namespace Tests\Unit\Company;

use App\Events\CompanyCreated;
use App\Listeners\LinkUserToCompany;
use App\Models\Company\CompanyInterface;
use App\Models\User\UserInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CompanyListenerTest extends TestCase
{
    use RefreshDatabase;

    public function test_listener_link_scholarship_to_company()
    {
        $company = $this->app->make(CompanyInterface::class)::factory()->create();
        $user = $this->app->make(UserInterface::class)::factory()->create();

        $listener = $this->app->make(LinkUserToCompany::class);

        $listener->handle(
            new CompanyCreated($user, $company)
        );

        $user->fresh();

        $this->assertEquals($company->id, $user->company->id);
    }
}
