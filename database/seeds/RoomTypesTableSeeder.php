<?php

use Illuminate\Database\Seeder;

class RoomTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\RoomType::create([
            'name' => 'โรงเรือน',
            'name_en' => 'Classroom',
            'is_default' => 1,
            'created_by' => 1
        ]);
        // App\RoomType::create([
        //     'name' => 'แปลงผัก',
        //     'name_en' => 'Meeting Room',
        //     'is_default' => 1,
        //     'created_by' => 1
        // ]);
    }
}
