<?php

namespace App\Models\Scholarship;

use App\Models\Company\Company;
use App\Models\EarnableTarget\EarnableTarget;
use Database\Factories\ScholarshipFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scholarship extends Model implements ScholarshipInterface
{
    use HasFactory;

    protected $guarded = [];

    protected static function newFactory()
    {
        return ScholarshipFactory::new();
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function earnableTargets()
    {
        return $this->hasMany(EarnableTarget::class);
    }


}
