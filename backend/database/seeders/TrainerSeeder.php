<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Trainer;

class TrainerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // get associated array of trainers
        $trainers = json_decode(file_get_contents("initial data/trainers.json"), true);

        foreach ($trainers as $trainer) {
            // $trainer["competencies"] = json_encode($trainer["competencies"]);
            Trainer::create($trainer);
        }
    }
}
