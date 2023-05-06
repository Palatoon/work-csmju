<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConditionListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            0 => array('name' => 'ON', 'value' => 'ON', 'device_type' => 6),
            1 => array('name' => 'OFF', 'value' => 'OFF', 'device_type' => 6),
            2 => array('name' => 'ON', 'value' => 'ON', 'device_type' => 7),
            3 => array('name' => 'OFF', 'value' => 'ON', 'device_type' => 7),
            4 => array('name' => 'ON', 'value' => 'ON', 'device_type' => 8),
            5 => array('name' => 'OFF', 'value' => 'OFF', 'device_type' => 8),
            6 => array('name' => 'สแกนหน้าคนแรก', 'value' => 'ON', 'device_type' => 18),
            7 => array('name' => 'สแกนหน้าผ่าน', 'value' => 'ON', 'device_type' => 18),
            8 => array('name' => 'สแกนหน้าไม่สแกนหน้าไม่ผ่าน', 'value' => 'OFF', 'device_type' => 18),
            9 => array('name' => '>', 'value' => 'NULL', 'device_type' => 20),
            10 => array('name' => '<', 'value' => 'NULL', 'device_type' => 20),
            11 => array('name' => '=', 'value' => 'NULL', 'device_type' => 20),
            12 => array('name' => 'ทำงานตามเวลา', 'value' => 'Time', 'device_type' => 22),
            13 => array('name' => 'ก่อนหมดเวลา', 'value' => 'Before-end', 'device_type' => 22),
            14 => array('name' => 'หมดเวลาจอง', 'value' => 'End', 'device_type' => 22),
            15 => array('name' => 'เคลื่อนไหว', 'value' => 'Motion', 'device_type' => 22),
        );

        foreach ($data as $key => $value) {
            DB::table('condition_list')->insert($value);
        }
    }
}
