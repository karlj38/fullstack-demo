<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    protected $casts = [
        "competencies" => "array",
        "needWheelchair" => "boolean"
    ];
}
