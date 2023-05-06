<?php

use App\Animal;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnimalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $faker = Faker::create();

        for ($i=0; $i < 600; $i++) { 
            Animal::create([
                'name' => $faker->firstName,
                'type_id' => rand(1,6)
            ]);
        }
    }
}
