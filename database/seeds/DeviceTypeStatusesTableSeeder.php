<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeviceTypeStatusesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            0 => array('device_type_id' => 1, 'name' => 'Default', 'icon' => 'information-outline', 'icon_color' => NULL, 'image' => NULL),
            1 => array('device_type_id' => 2, 'name' => 'Default', 'icon' => 'cctv', 'icon_color' => NULL, 'image' => NULL),
            2 => array('device_type_id' => 2, 'name' => 'On', 'icon' => 'cctv', 'icon_color' => 'green', 'image' => NULL),
            3 => array('device_type_id' => 2, 'name' => 'Off', 'icon' => 'cctv', 'icon_color' => 'red', 'image' => NULL),
            4 => array('device_type_id' => 3, 'name' => 'Default', 'icon' => 'remote-off', 'icon_color' => NULL, 'image' => NULL),
            5 => array('device_type_id' => 3, 'name' => 'On', 'icon' => 'remote', 'icon_color' => 'green', 'image' => NULL),
            6 => array('device_type_id' => 3, 'name' => 'Off', 'icon' => 'remote-off', 'icon_color' => 'red', 'image' => NULL),
            7 => array('device_type_id' => 4, 'name' => 'Default', 'icon' => 'camera-account', 'icon_color' => NULL, 'image' => NULL),
            8 => array('device_type_id' => 4, 'name' => 'On', 'icon' => 'camera-account', 'icon_color' => 'green', 'image' => NULL),
            9 => array('device_type_id' => 4, 'name' => 'Off', 'icon' => 'camera-account', 'icon_color' => 'red', 'image' => NULL),
            10 => array('device_type_id' => 5, 'name' => 'Default', 'icon' => 'speedometer-slow', 'icon_color' => NULL, 'image' => NULL),
            11 => array('device_type_id' => 6, 'name' => 'Default', 'icon' => 'light-switch', 'icon_color' => NULL, 'image' => NULL),
            12 => array('device_type_id' => 6, 'name' => 'On', 'icon' => 'light-switch', 'icon_color' => '#00FF24', 'image' => NULL),
            13 => array('device_type_id' => 6, 'name' => 'Default', 'icon' => 'light-switch', 'icon_color' => 'red', 'image' => NULL),
            14 => array('device_type_id' => 7, 'name' => 'Default', 'icon' => 'gamepad-circle-right', 'icon_color' => NULL, 'image' => NULL),
            15 => array('device_type_id' => 8, 'name' => 'Default', 'icon' => 'motion-sensor', 'icon_color' => NULL, 'image' => NULL),
            16 => array('device_type_id' => 9, 'name' => 'Default', 'icon' => 'fan-alert', 'icon_color' => NULL, 'image' => NULL),
            17 => array('device_type_id' => 9, 'name' => 'On', 'icon' => 'fan', 'icon_color' => 'green', 'image' => NULL),
            18 => array('device_type_id' => 9, 'name' => 'Off', 'icon' => 'fan', 'icon_color' => 'red', 'image' => NULL),
            19 => array('device_type_id' => 10, 'name' => 'Default', 'icon' => 'lightbulb-off-outline', 'icon_color' => NULL, 'image' => NULL),
            20 => array('device_type_id' => 10, 'name' => 'On', 'icon' => 'lightbulb-on-outline', 'icon_color' => 'green', 'image' => NULL),
            21 => array('device_type_id' => 10, 'name' => 'Off', 'icon' => 'lightbulb', 'icon_color' => 'red', 'image' => NULL),
            22 => array('device_type_id' => 11, 'name' => 'On', 'icon' => 'air-conditioner', 'icon_color' => 'green', 'image' => NULL),
            23 => array('device_type_id' => 11, 'name' => 'Off', 'icon' => 'air-conditioner', 'icon_color' => 'red', 'image' => NULL),
            24 => array('device_type_id' => 11, 'name' => 'Default', 'icon' => 'air-conditioner', 'icon_color' => NULL, 'image' => NULL),
            25 => array('device_type_id' => 12, 'name' => 'Default', 'icon' => 'television-off', 'icon_color' => NULL, 'image' => NULL),
            26 => array('device_type_id' => 12, 'name' => 'On', 'icon' => 'television', 'icon_color' => 'green', 'image' => NULL),
            27 => array('device_type_id' => 12, 'name' => 'Off', 'icon' => 'television-off', 'icon_color' => 'red', 'image' => NULL),
            28 => array('device_type_id' => 13, 'name' => 'Default', 'icon' => 'air-filter', 'icon_color' => NULL, 'image' => NULL),
            29 => array('device_type_id' => 13, 'name' => 'On', 'icon' => 'air-filter', 'icon_color' => 'green', 'image' => NULL),
            30 => array('device_type_id' => 13, 'name' => 'Off', 'icon' => 'air-filter', 'icon_color' => 'red', 'image' => NULL),
            31 => array('device_type_id' => 14, 'name' => 'On', 'icon' => 'speaker', 'icon_color' => '#0EF924', 'image' => NULL),
            32 => array('device_type_id' => 14, 'name' => 'Off', 'icon' => 'speaker-off', 'icon_color' => 'red', 'image' => NULL),
            33 => array('device_type_id' => 14, 'name' => 'Default', 'icon' => 'speaker-off', 'icon_color' => NULL, 'image' => NULL),
            34 => array('device_type_id' => 15, 'name' => 'On', 'icon' => 'door-open', 'icon_color' => 'green', 'image' => NULL),
            35 => array('device_type_id' => 15, 'name' => 'Off', 'icon' => 'door-closed', 'icon_color' => 'red', 'image' => NULL),
            36 => array('device_type_id' => 15, 'name' => 'Default', 'icon' => 'door-closed', 'icon_color' => NULL, 'image' => NULL),
            37 => array('device_type_id' => 16, 'name' => 'Default', 'icon' => 'thermometer', 'icon_color' => NULL, 'image' => NULL),
            38 => array('device_type_id' => 17, 'name' => 'Default', 'icon' => 'water-percent', 'icon_color' => NULL, 'image' => NULL),
            39 => array('device_type_id' => 18, 'name' => 'Default', 'icon' => 'door-closed-lock', 'icon_color' => NULL, 'image' => NULL),
            40 => array('device_type_id' => 19, 'name' => 'Default', 'icon' => 'human-male', 'icon_color' => NULL, 'image' => NULL),
            41 => array('device_type_id' => 19, 'name' => 'Detect', 'icon' => 'run', 'icon_color' => 'green', 'image' => NULL),
            42 => array('device_type_id' => 19, 'name' => 'Off', 'icon' => 'human-male', 'icon_color' => 'red', 'image' => NULL),
            43 => array('device_type_id' => 20, 'name' => 'Default', 'icon' => 'memory', 'icon_color' => NULL, 'image' => NULL),
            44 => array('device_type_id' => 21, 'name' => 'Default', 'icon' => 'text-to-speech', 'icon_color' => NULL, 'image' => NULL),
            45 => array('device_type_id' => 22, 'name' => 'Default', 'icon' => 'calendar', 'icon_color' => NULL, 'image' => NULL),
            46 => array('device_type_id' => 23, 'name' => 'Default', 'icon' => 'molecule-co2', 'icon_color' => NULL, 'image' => NULL),
            47 => array('device_type_id' => 24, 'name' => 'Default', 'icon' => 'gamepad-circle', 'icon_color' => NULL, 'image' => NULL),
            48 => array('device_type_id' => 25, 'name' => 'Default', 'icon' => 'google-circles-extended', 'icon_color' => NULL, 'image' => NULL),
            49 => array('device_type_id' => 26, 'name' => 'Default', 'icon' => 'necklace', 'icon_color' => NULL, 'image' => NULL),
            50 => array('device_type_id' => 27, 'name' => 'Default', 'icon' => 'baby-bottle-outline', 'icon_color' => NULL, 'image' => NULL),
            51 => array('device_type_id' => 28, 'name' => 'Default', 'icon' => 'scale', 'icon_color' => NULL, 'image' => NULL),
            52 => array('device_type_id' => 29, 'name' => 'Default', 'icon' => 'format-line-weight', 'icon_color' => NULL, 'image' => NULL),
            53 => array('device_type_id' => 30, 'name' => 'Default', 'icon' => 'water-pump', 'icon_color' => NULL, 'image' => NULL),
            54 => array('device_type_id' => 31, 'name' => 'Default', 'icon' => 'home-thermometer', 'icon_color' => NULL, 'image' => NULL),
            55 => array('device_type_id' => 32, 'name' => 'Default', 'icon' => 'fan-auto', 'icon_color' => NULL, 'image' => NULL),
            56 => array('device_type_id' => 33, 'name' => 'Default', 'icon' => 'snowflake-alert', 'icon_color' => NULL, 'image' => NULL),
            57 => array('device_type_id' => 34, 'name' => 'Default', 'icon' => 'lightning-bolt', 'icon_color' => NULL, 'image' => NULL),
            58 => array('device_type_id' => 35, 'name' => 'Default', 'icon' => 'fan-plus', 'icon_color' => NULL, 'image' => NULL),
            59 => array('device_type_id' => 36, 'name' => 'Default', 'icon' => 'meter-gas', 'icon_color' => NULL, 'image' => NULL),
            60 => array('device_type_id' => 37, 'name' => 'Default', 'icon' => 'camera-front', 'icon_color' => NULL, 'image' => NULL),
            61 => array('device_type_id' => 38, 'name' => 'Default', 'icon' => 'bowl', 'icon_color' => NULL, 'image' => NULL),
        );

        foreach ($data as $key => $value) {
            DB::table('device_type_statuses')->insert($value);
        }
    }
}
