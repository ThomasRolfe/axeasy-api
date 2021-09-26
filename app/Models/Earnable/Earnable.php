<?php

namespace App\Models\Earnable;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Earnable extends Model implements EarnableInterface
{
    use HasFactory;

    protected $guarded = [];
}
