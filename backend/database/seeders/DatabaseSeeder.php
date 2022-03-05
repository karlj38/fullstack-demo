<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\{
    BookingSeeder,
    CourseSeeder,
    LocationSeeder,
    StudentSeeder,
    TrainerSeeder
};

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            CourseSeeder::class,
            LocationSeeder::class,
            StudentSeeder::class,
            TrainerSeeder::class,
            BookingSeeder::class
        ]);
    }
}
