<?php

namespace Tests\Feature\EarnableTarget;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EarnableTargetEndpointTest extends TestCase
{

    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $this->artisan('db:seed');
    }

    public function test_endpoint_earnable_target_can_be_created()
    {
    }

    public function test_endpoint_earnable_target_with_invalid_earnable_throws_exception()
    {
    }

    public function test_endpoint_earnable_target_with_invalid_time_frequency_throws_exception()
    {
    }

}
