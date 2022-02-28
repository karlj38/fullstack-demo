<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Location;

class LocationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get associated array of locations
        $locations = json_decode(file_get_contents("initial data/locations.json"), true);

        foreach ($locations as $location) {
            Location::create($location);
        }
    }
}
