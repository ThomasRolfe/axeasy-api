<?php

namespace Tests\Unit\User;

use App\Models\User;
use App\Repositories\User\UserRepository;
use App\Repositories\User\UserRepositoryInterface;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class UserRepositoryTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    public function test_user_repository_returns_current_user_data()
    {
        $user = User::factory()->create();

        $this->actingAs($user);

        $repository = $this->app->make(UserRepositoryInterface::class);
        $data = $repository->current();

        $this->assertTrue($user->is($data));
    }

    public function test_user_repository_finds_individual_user()
    {
        $user = User::factory()->create();

        $repository = $this->app->make(UserRepositoryInterface::class);
        $data = $repository->find($user->id);

        $this->assertTrue($user->is($data));
    }



}
