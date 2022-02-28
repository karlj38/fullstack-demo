<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $casts = [
        "students" => "array",
        "certificate_needed" => "boolean"
    ];
}
