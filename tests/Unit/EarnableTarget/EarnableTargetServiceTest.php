<?php

namespace Tests\Unit\EarnableTarget;

use App\Models\Scholarship\ScholarshipInterface;
use App\Services\Earnables\Interfaces\CreatesEarnableTarget;
use App\Services\Earnables\Interfaces\GetsEarnable;
use App\ValueObjects\TimeFrequency\TimeFrequency;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EarnableTargetServiceTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_service_earnable_target_can_be_created_for_a_scholarship()
    {
        $earnableTargetService = $this->app->make(CreatesEarnableTarget::class);
        $earnableService = $this->app->make(GetsEarnable::class);

        $scholarship = $this->app->make(ScholarshipInterface::class)::factory()->create();
        $earnable = $earnableService->getByLabel('SLP');
        $frequency = TimeFrequency::makeMonthly();

        $target = $earnableTargetService->create($scholarship, $earnable, 3000, $frequency);

        $this->assertTrue($scholarship->earnableTargets->contains($target));
    }

    public function test_service_earnable_target_is_overwritten()
    {
        $earnableTargetService = $this->app->make(CreatesEarnableTarget::class);
        $earnableService = $this->app->make(GetsEarnable::class);

        $scholarship = $this->app->make(ScholarshipInterface::class)::factory()->create();
        $earnable = $earnableService->getByLabel('SLP');
        $frequency = TimeFrequency::makeMonthly();

        $earnableTargetService->create($scholarship, $earnable, 3000, $frequency);

        $frequency = TimeFrequency::makeWeekly();
        $newTarget = $earnableTargetService->create($scholarship, $earnable, 5000, $frequency);

        $this->assertTrue($scholarship->earnableTargets->contains($newTarget));
    }

    public function test_service_earnable_target_cannot_be_made_with_incorrect_attributes()
    {
        $earnableTargetService = $this->app->make(CreatesEarnableTarget::class);
        $this->expectError();
        $earnableTargetService->create(null, null, 'a string', null);
    }

}
