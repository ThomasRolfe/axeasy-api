<?php

namespace App\Repositories\User;

use App\Models\User\User;
use App\Repositories\BaseRepository;
use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function current(): ?Authenticatable
    {
        return Auth::user();
    }

    public function find($id): ?Model
    {
        return User::find($id);
    }

    public function all(): Collection
    {
        return User::all();
    }
}
