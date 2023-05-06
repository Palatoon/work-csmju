<?php

use Illuminate\Database\Seeder;

class AreasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\Area::create([
            'name' => 'พื้นที่ 1',
            'name_en' => 'พื้นที่ 1',
            'description' => NULL,
            'floor_plan_image' => 'public/img/floor_plan/farm_1.png',
            'x' => 47,
            'y' => 33,
            'visible' => 1,
            'building_id' => 1,
            'created_by' => 1
        ]);

        // App\Area::create([
        //     'name' => 'พื้นที่ 2',
        //     'name_en' => 'พื้นที่ 2',
        //     'description' => NULL,
        //     'floor_plan_image' => 'public/img/floor_plan/area_2.jpg',
        //     'building_id' => 1,
        //     'created_by' => 1
        // ]);
    }
}
