<?php

use App\AnimalType;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class AnimalTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\AnimalType::create([
            'name' => 'โคนม',
            'name_en' => 'dairy cattle',
        ]);

        App\AnimalType::create([
            'name' => 'โคเนื้อ',
            'name_en' => 'beef cattle',

        ]);
        App\AnimalType::create([
            'name' => 'กระบือเนื้อ',
            'name_en' => 'beef buffalo',
        ]);

        App\AnimalType::create([
            'name' => 'แพะ',
            'name_en' => 'goat',
        ]);
        App\AnimalType::create([
            'name' => 'หมู',
            'name_en' => 'pig',
        ]);

        App\AnimalType::create([
            'name' => 'ไก่',
            'name_en' => 'chicken',
        ]);
    }
}
