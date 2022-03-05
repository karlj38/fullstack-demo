<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{
    Course,
    Location,
    Trainer
};

class Booking extends Model
{
    use HasFactory;

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

    public function course() {
        return $this->belongsTo(Course::class);
    }

    public function location() {
        return $this->belongsTo(Location::class);
    }

    public function trainer() {
        return $this->belongsTo(Trainer::class);
    }
}
