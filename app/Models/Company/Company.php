<?php

namespace App\Models\Company;

use App\Models\Scholarship\Scholarship;
use App\Models\User\User;
use Database\Factories\CompanyFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected static function newFactory()
    {
        return CompanyFactory::new();
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function scholarships()
    {
        return $this->hasMany(Scholarship::class);
    }
}
