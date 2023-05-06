<?php

use Illuminate\Database\Seeder;

class BuildingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Building::create([
            'name' => 'ฟาร์ม 1',
            'name_en' => 'ฟาร์ม 1',
            'description' => NULL,
            'floor_plan_image' => 'public/img/floor_plan/farm_1.png',
            'created_by' => 1
        ]);

        // App\Building::create([
        //     'name' => 'ฟาร์ม 2',
        //     'name_en' => 'ฟาร์ม 2',
        //     'description' => NULL,
        //     'floor_plan_image' => 'public/img/floor_plan/farm_2.jpg',
        //     'created_by' => 1
        // ]);
    }
}
