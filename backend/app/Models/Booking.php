<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    protected $casts = [
        "students" => "array",
        "certificate_needed" => "boolean"
    ];

    protected $fillable = [
        "course_id",
        "location_id",
        "trainer_id",
        "students",
        "start",
        "end",
        "certificate_needed",
        "comments",
    ];
}
