<?php

use Illuminate\Database\Seeder;

class DeviceTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = array(
            0 => array('name' => 'Default', 'name_en' => 'Default', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            1 => array('name' => 'Camera', 'name_en' => 'Camera', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            2 => array('name' => 'MitsubishiIR', 'name_en' => 'MitsubishiIR', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            3 => array('name' => 'Counting Camera', 'name_en' => 'Counting Camera', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            4 => array('name' => 'cacheRelay', 'name_en' => 'cacheRelay', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            5 => array('name' => 'Switch', 'name_en' => 'Switch', 'description' => 'Switch', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            6 => array('name' => 'Scene', 'name_en' => 'Scene', 'description' => 'Scene', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            7 => array('name' => 'Binary', 'name_en' => 'Binary', 'description' => 'binary sensor', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            8 => array('name' => 'พัดลม', 'name_en' => 'Fan', 'description' => 'Switch', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            9 => array('name' => 'หลอดไฟ', 'name_en' => 'Light', 'description' => 'Switch', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            10 => array('name' => 'แอร์', 'name_en' => 'Air Conditioner', 'description' => 'Scene', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            11 => array('name' => 'ทีวี', 'name_en' => 'TV', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            12 => array('name' => 'เครื่องฟอกอากาศ', 'name_en' => 'Air Purifier', 'description' => 'Switch', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            13 => array('name' => 'Speaker', 'name_en' => 'Speaker', 'description' => 'Switch', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            14 => array('name' => 'ประตู', 'name_en' => 'Door', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            15 => array('name' => 'Temperature', 'name_en' => 'Temperature', 'description' => 'Sensor', 'is_default' => 1, 'created_by' => 1, 'default_unit' => '°C'),
            16 => array('name' => 'Humidity', 'name_en' => 'Humidity', 'description' => 'Sensor', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            17 => array('name' => 'Access Control', 'name_en' => 'Access Control', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            18 => array('name' => 'Motion', 'name_en' => 'Motion', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            19 => array('name' => 'Sensor', 'name_en' => 'Sensor', 'description' => 'Sensor', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            20 => array('name' => 'tts', 'name_en' => 'tts', 'description' => 'tts', 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            21 => array('name' => 'Calendar', 'name_en' => 'Calendar', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            22 => array('name' => 'CO2', 'name_en' => 'CO2', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            23 => array('name' => 'PM10', 'name_en' => 'PM10', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            24 => array('name' => 'PM25', 'name_en' => 'PM25', 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            25 => array('name' => 'ปลอกคอ/สายคล้องคอ', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            26 => array('name' => 'เครื่องรีดนม', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            27 => array('name' => 'เครื่องชั่งน้ำหนัก', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            28 => array('name' => 'อุปกรณ์วัดขนาดสัตว์', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            29 => array('name' => 'อุปกรณ์บันทึกการให้น้ำสัตว์', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            30 => array('name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            31 => array('name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            32 => array('name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            33 => array('name' => 'มิเตอร์', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            34 => array('name' => 'อุปกรณ์ควบคุมพัดลม', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            35 => array('name' => 'อุปกรณ์ตรวจวัดปริมาณแก๊สแอมโมเนีย', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            36 => array('name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL),
            37 => array('name' => 'อุปกรณ์กกสุกร', 'name_en' => NULL, 'description' => NULL, 'is_default' => 1, 'created_by' => 1, 'default_unit' => NULL)
        );

        foreach ($data as $key => $value) {
            App\DeviceType::create($value);
        }
    }
}
