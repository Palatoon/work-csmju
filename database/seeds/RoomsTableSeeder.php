<?php

use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $buildings = App\Building::all()->pluck('id')->toArray();

        $roomtypes = App\RoomType::all()->pluck('id')->toArray();

        $display_type = ['always', 'hover', 'hide'];
        $rand_keys = array_rand($display_type, 2);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงโคนม 3',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'floor_plan_image' => 'public/img/floor_plan/b3_cow.png',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 75,
            'y' => 31,
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงโคนม 4',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'floor_plan_image' => 'public/img/floor_plan/b4_cow.jpg',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 75,
            'y' => 23,
            'display_status' => $display_type[0],
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงโคเนื้อ 9',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'floor_plan_image' => 'public/img/floor_plan/b9_cow_meet.png',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 42,
            'y' => 33,
            'display_status' => $display_type[0],
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงกระบือ 10',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'floor_plan_image' => 'public/img/floor_plan/b10_kwai.png',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 42,
            'y' => 18,
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงแพะ 5',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 62,
            'y' => 18,
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงแพะ 6',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 62,
            'y' => 33,
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงหมู 11',
            'seat' => '50',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 21,
            'y' => 22,
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงไก่ไข่ 12',
            'seat' => '500',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 21,
            'y' => 40,
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);

        App\Room::create([
            'name' => 'โรงเรือนเลี้ยงไก่เนื้อ 13',
            'seat' => '500',
            'description' => NULL,
            'room_type_id' => '1',
            'area_id' => '1',
            'auto_approve' => '1',
            'created_by' => 1,
            'x' => 21,
            'y' => 49,
            'display_status' => $display_type[0],
            'visible' => 1,
            'disable' => 1,
            'created_by' => 1
        ]);
    }
}
