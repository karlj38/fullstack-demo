<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get associated array of courses
        $courses = json_decode(file_get_contents("initial data/courses.json"), true);

        foreach ($courses as $course) {
            Course::create($course);
        }
    }
}
