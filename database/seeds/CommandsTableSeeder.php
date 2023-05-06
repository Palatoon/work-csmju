<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CommandsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            0 => array('device_type_id' => 3, 'command_name' => 'On_receive', 'command_value' => 'completeir,<id>,<ircodeon>'),
            1 => array('device_type_id' => 3, 'command_name' => 'Off_receive', 'command_value' => 'completeir,<id>,<ircodeoff>'),
            2 => array('device_type_id' => 3, 'command_name' => 'On', 'command_value' => 'sendir,<id>,<ircodeon>'),
            3 => array('device_type_id' => 3, 'command_name' => 'Off', 'command_value' => 'sendif,<id>,<ircodeoff>'),
            4 => array('device_type_id' => 5, 'command_name' => 'On', 'command_value' => 'setstate,<id>,0'),
            5 => array('device_type_id' => 5, 'command_name' => 'Off', 'command_value' => 'setstate,<id>,1'),
            6 => array('device_type_id' => 5, 'command_name' => 'On_receive', 'command_value' => 'state,<id>,0'),
            7 => array('device_type_id' => 5, 'command_name' => 'Off_recieve', 'command_value' => 'state,<id>,1'),
            8 => array('device_type_id' => 6, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            9 => array('device_type_id' => 6, 'command_name' => 'OFF', 'command_value' => 'turn_off'),
            10 => array('device_type_id' => 7, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            11 => array('device_type_id' => 7, 'command_name' => 'OFF', 'command_value' => 'turn_on'),
            12 => array('device_type_id' => 9, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            13 => array('device_type_id' => 9, 'command_name' => 'OFF', 'command_value' => 'turn_off'),
            14 => array('device_type_id' => 10, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            15 => array('device_type_id' => 10, 'command_name' => 'OFF', 'command_value' => 'turn_off'),
            16 => array('device_type_id' => 11, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            17 => array('device_type_id' => 11, 'command_name' => 'OFF', 'command_value' => 'turn_on'),
            18 => array('device_type_id' => 13, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            19 => array('device_type_id' => 13, 'command_name' => 'OFF', 'command_value' => 'turn_off'),
            20 => array('device_type_id' => 14, 'command_name' => 'ON', 'command_value' => 'turn_on'),
            21 => array('device_type_id' => 14, 'command_name' => 'OFF', 'command_value' => 'turn_off'),
            22 => array('device_type_id' => 22, 'command_name' => 'Speak', 'command_value' => 'Speak'),
        );

        foreach ($data as $key => $value) {
            DB::table('commands')->insert($value);
        }
    }
}
