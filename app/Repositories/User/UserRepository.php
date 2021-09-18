<?php

namespace App\Repositories\User;

use App\Models\User\UserInterface;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(UserInterface $model)
    {
        parent::__construct($model);
    }

    public function current(): ?Authenticatable
    {
        return Auth::user();
    }
}
