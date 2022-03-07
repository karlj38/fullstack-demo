<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\{
    Course,
    Location,
    Student,
    Trainer,
};
use Carbon\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Booking>
 */
class BookingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $location = null;

        while (!$location) {
            $course = Course::inRandomOrder()->first();

            $trainer = Trainer::where("level", ">=", $course->level)
            ->whereJsonContains("competencies", $course->topic)
            ->inRandomOrder()
            ->first();

            $location = Location::where("city", $trainer->city)
            ->when($trainer->needWheelchair, function($query) {
                $query->where("wheelchairAccessible", true);
            })
            ->inRandomOrder()
            ->first();
        }

        $students = Student::when(!$location->wheelchairAccessible, function ($query) {
            $query->where("needWheelchair", false);
        })
        ->inRandomOrder()
        ->limit($this->faker->numberBetween(5,10));

        $start = $this->faker->dateTimeThisYear('+3 months');

        $end = Carbon::create($start)->addDays($course->duration);

        return [
            'course_id' => $course->id,
            'location_id' => $location->id,
            'trainer_id' => $trainer->id,
            'students' => $students->pluck('id'),
            'start' => $start,
            'end' => $end,
            'certificate_needed' => $this->faker->boolean(),
            'comments' =>$this->faker->optional()->sentence()
        ];
    }
}
