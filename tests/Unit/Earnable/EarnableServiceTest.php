<?php

namespace Tests\Unit\Earnable;

use App\Exceptions\EarnableNotFound;
use App\Services\Earnables\Interfaces\GetsEarnable;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class EarnableServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_service_an_incorrect_label_throws_earnable_not_found_exception()
    {
        $earnableService = $this->app->make(GetsEarnable::class);

        $this->expectException(EarnableNotFound::class);

        $earnableService->getByLabel('INVALID EARNABLE LABEL');
    }
}
