<?php

namespace App\Models\EarnableTarget;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EarnableTarget extends Model implements EarnableTargetInterface
{
    use HasFactory;

    protected $guarded = [];
}
