<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ConfigurationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $configs = array(
            0 => array('name' => 'domain', 'name_th' => NULL, 'name_en' => 'Domain', 'value' => '10.3.0.11', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ad', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            1 => array('name' => 'suffix', 'name_th' => NULL, 'name_en' => 'Suffix', 'value' => '@lanna.co.th', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ad', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            2 => array('name' => 'organization-unit', 'name_th' => NULL, 'name_en' => 'Organization Unit', 'value' => 'OU=Organization,DC=lanna,DC=co,DC=th', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ad', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            3 => array('name' => 'admin-username', 'name_th' => NULL, 'name_en' => 'Admin Username', 'value' => 'scriptadmin', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ad', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            4 => array('name' => 'admin-password', 'name_th' => NULL, 'name_en' => 'Admin Password', 'value' => 'QQRjr1jLMDpG/TtQfxgkQA==', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ad', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            5 => array('name' => 'application-id', 'name_th' => NULL, 'name_en' => 'Application (client) ID', 'value' => '539776c5-3d8c-4e95-8e8b-79b1b2be2914', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ms-graph', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            6 => array('name' => 'directory-id', 'name_th' => NULL, 'name_en' => 'Directory (tenant) ID', 'value' => NULL, 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ms-graph', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            7 => array('name' => 'client-secrets', 'name_th' => NULL, 'name_en' => 'Client Secrets', 'value' => NULL, 'unit' => NULL, 'unit_th' => NULL, 'type' => 'ms-graph', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            8 => array('name' => 'booking-per-week', 'name_th' => 'จำนวนครั้งการจองใน 1 อาทิตย์', 'name_en' => NULL, 'value' => '888', 'unit' => 'count', 'unit_th' => 'ครั้ง/อาทิตย์', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            9 => array('name' => 'booking-per-day', 'name_th' => 'จำนวนครั้งการจองใน 1 วัน', 'name_en' => NULL, 'value' => '999', 'unit' => 'count', 'unit_th' => 'ครั้ง/วัน', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            10 => array('name' => 'booking-ahead-day', 'name_th' => 'จองล่วงหน้า', 'name_en' => NULL, 'value' => '3', 'unit' => 'day', 'unit_th' => 'วัน', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            11 => array('name' => 'booking-hour-max', 'name_th' => 'ชั่วโมงการจองสูงสุด', 'name_en' => NULL, 'value' => '3', 'unit' => 'hour', 'unit_th' => 'ชั่วโมง', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            12 => array('name' => 'booking-hour-min', 'name_th' => 'ชั่วโมงการจองขั้นต่ำ', 'name_en' => NULL, 'value' => '1', 'unit' => 'hour', 'unit_th' => 'ชั่วโมง', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            13 => array('name' => 'before-start', 'name_th' => 'สามารถเข้าห้องได้ก่อนเวลา', 'name_en' => NULL, 'value' => '0', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            14 => array('name' => 'after-end', 'name_th' => 'สามารถเข้าห้องได้หลังจบการจอง', 'name_en' => NULL, 'value' => '0', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            15 => array('name' => 'after-start', 'name_th' => 'ยกเลิกตารางหากผู้จองไม่มาใช้งานภายใน', 'name_en' => NULL, 'value' => '10', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            16 => array('name' => 'max-participant', 'name_th' => 'จำนวนผู้เข้าร่วมสูงสุด', 'name_en' => NULL, 'value' => '1', 'unit' => 'person', 'unit_th' => 'คน', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            17 => array('name' => 'blank-room-time', 'name_th' => 'ยกเลิกตารางเมื่อผู้ใช้ออกจากห้องนานกว่า', 'name_en' => NULL, 'value' => '10', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            18 => array('name' => 'time-step', 'name_th' => 'ช่วงนาทีการจอง', 'name_en' => NULL, 'value' => '1', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            19 => array('name' => 'before-end', 'name_th' => 'เวลาแจ้งเตือนก่อนหมดเวลา', 'name_en' => NULL, 'value' => '10', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            20 => array('name' => 'after-using-end', 'name_th' => 'เวลาเว้นว่างหลังการใช้งานห้อง', 'name_en' => NULL, 'value' => '0', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            21 => array('name' => 'light-on', 'name_th' => 'กระพริบไฟด้วยการเปิด', 'name_en' => NULL, 'value' => '3', 'unit' => 'times', 'unit_th' => 'วินาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            22 => array('name' => 'light-off', 'name_th' => 'กระพริบไฟด้วยการปิด', 'name_en' => NULL, 'value' => '2', 'unit' => 'times', 'unit_th' => 'วินาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            23 => array('name' => 'alert-end', 'name_th' => 'แจ้งเตือนทุกๆ', 'name_en' => NULL, 'value' => '2', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            24 => array('name' => 'message-motion', 'name_th' => 'ข้อความแจ้งเตือนการเคลื่อนไหว', 'name_en' => NULL, 'value' => 'กรุณาเคลื่อนไหวด้วยค่ะ', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            25 => array('name' => 'message-end', 'name_th' => 'ข้อความแจ้งเตือนหมดเวลา', 'name_en' => NULL, 'value' => 'ขณะนี้เหลือเวลาอีก', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            26 => array('name' => 'alert-motion', 'name_th' => 'แจ้งเตือนหลังจากไม่มีการขยับ', 'name_en' => NULL, 'value' => '2', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            27 => array('name' => 'message-air-purifier', 'name_th' => 'ข้อความแจ้งเตือนเครื่องฟอกอากาศ', 'name_en' => NULL, 'value' => 'เครื่องฟอกอากาศจะทำงานใน', 'unit' => NULL, 'unit_th' => NULL, 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            28 => array('name' => 'alert-air-purifier', 'name_th' => 'แจ้งเตือนเครื่องฟอกอากาศ', 'name_en' => NULL, 'value' => '3', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
            29 => array('name' => 'service-time', 'name_th' => 'ปรับเวลาทำงานของ Service', 'name_en' => NULL, 'value' => '1', 'unit' => 'minute', 'unit_th' => 'นาที', 'type' => 'quota-booking', 'is_default' => '1', 'disable' => '0', 'created_by' => NULL),
        );

        foreach ($configs as $key => $value) {
            App\Configurations::create($value);
        }

        $power_configs = array(
            0 => array('Name' => 'price', 'Name_TH' => 'ราคา (บาท/Unit)', 'Value' => '4.12', 'Unit' => 'Baht', 'notify_status' => NULL),
            1 => array('Name' => 'day-notify', 'Name_TH' => 'เวลาแจ้งเตือน (วัน)', 'Value' => '14', 'Unit' => NULL, 'notify_status' => 1),
            2 => array('Name' => 'month-notify', 'Name_TH' => 'เวลาแจ้งเตือน (เดือน)', 'Value' => '10', 'Unit' => NULL, 'notify_status' => 1),
            3 => array('Name' => 'volt-below', 'Name_TH' => 'ไฟตก แรงดัน (Volt) ต่ำกว่า', 'Value' => '180', 'Unit' => NULL, 'notify_status' => 1),
            4 => array('Name' => 'volt-upper', 'Name_TH' => 'ไฟเกิน แรงดัน (Volt) สูงกว่า', 'Value' => '280', 'Unit' => NULL, 'notify_status' => 1),
            5 => array('Name' => 'current-upper', 'Name_TH' => 'กระแสไฟฟ้า (Amp) สูงกว่า', 'Value' => '45', 'Unit' => NULL, 'notify_status' => 1),
            6 => array('Name' => 'power-off', 'Name_TH' => 'ไฟดับ', 'Value' => '0', 'Unit' => NULL, 'notify_status' => 1),
        );

        foreach ($power_configs as $key => $value) {
            DB::table('configurations')->insert([
                'name' => $value['Name'],
                'name_th' => $value['Name_TH'],
                'name_en' =>  NULL,
                'value' => $value['Value'],
                'unit' => $value['Unit'],
                'unit_th' => NULL,
                'notify_status' => $value['notify_status'],
                'type' => 'power-meter',
                'is_default' => '1',
                'disable' => '0',
                'created_by' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
