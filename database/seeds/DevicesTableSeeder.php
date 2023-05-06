<?php

use App\Datacode;
use App\DeviceDatacode;
use Illuminate\Database\Seeder;

class DevicesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $devices = array(
        //     0 => array(
        //         'ip' => 'hikvision2.lanna.co.th',
        //         'macaddress' => '98:df:82:95:66:7b',
        //         'serial_id' => '0',
        //         'name' => 'Hikvision Flr.2',
        //         'device_type_id' => 1,
        //         'username' => 'admin',
        //         'password' => 'wiYIuOE0m8adbkUrHokwMA==',
        //         'room_id' => '2',
        //         'created_by' => 1
        //     ),
        //     1 => array(
        //         'ip' => 'hikvision1.lanna.co.th',
        //         'macaddress' => '1',
        //         'serial_id' => '1',
        //         'name' => 'hikvision',
        //         'device_type_id' => 1,
        //         'username' => 'admin',
        //         'password' => 'wiYIuOE0m8adbkUrHokwMA==',
        //         'room_id' => '1',
        //         'created_by' => 1
        //     ),
        //     2 => array(
        //         'ip' => '192.168.24.50',
        //         'macaddress' => '11:11:11:11:11:11',
        //         'serial_id' => '12345678',
        //         'name' => 'Dorm Camera',
        //         'device_type_id' => 2,
        //         'username' => 'admin',
        //         'password' => 'wiYIuOE0m8adbkUrHokwMA==',
        //         'room_id' => '3',
        //         'created_by' => 1
        //     ),
        //     3 => array(
        //         'ip' => '192.168.24.7',
        //         'macaddress' => '99:99:99:99:99:99',
        //         'serial_id' => '132132132',
        //         'name' => 'CCTV',
        //         'device_type_id' => 2,
        //         'username' => 'admin',
        //         'password' => 'L@nnac0m',
        //         'room_id' => '1',
        //         'created_by' => 1
        //     ),
        //     4 => array(
        //         'ip' => '192.168.10.76',
        //         'macaddress' => '00:00:00:00:00',
        //         'serial_id' => '1a2sd12sa1d',
        //         'name' => 'access ct',
        //         'device_type_id' => 1,
        //         'username' => 'admin',
        //         'password' => 'wiYIuOE0m8adbkUrHokwMA==',
        //         'room_id' => '4',
        //         'created_by' => 1
        //     ),
        //     5 => array(
        //         'ip' => '192.168.24.8',
        //         'macaddress' => '77:77:77:77:77',
        //         'serial_id' => '1a2sd12sa1d',
        //         'name' => 'human detect',
        //         'device_type_id' => 2,
        //         'username' => 'admin',
        //         'password' => '0u5SzjGapO1xvma6+w5C0A==',
        //         'room_id' => '4',
        //         'created_by' => 1
        //     ),
        // );

        // $devices = array(
        //     0 => array('room_id' => '1', 'name' => 'ปลอกคอ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายห้อยคอสำหรับตรวจสอบพฤติกรรมวัวสำหรับโคนม พร้อมโปรแกรมบันทึกสถิติและเครื่องรับสัญญาณหลัก', 'count' => '15'),
        //     1 => array('room_id' => '1', 'name' => 'เครื่องรีดนม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์รีดนมวัวพร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '3'),
        //     2 => array('room_id' => '1', 'name' => 'เครื่องชั่งน้ำหนักวัว', 'name_en' => 'Dynaweight', 'brand' => 'Dynaweight', 'model' => 'DW-218', 'description' => 'เครื่องชั่งน้ำหนักวัวขนาดไม่เกิน 2 ตัน ขนาด 90(W)x180(L)x180(H)cm. อ่านค่าละเอียดที่ 1kg พร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
        //     3 => array('room_id' => '1', 'name' => 'อุปกรณ์วัดขนาดโคนม', 'name_en' => 'Camera + Housing', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์วัดขนาดโคนมพร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
        //     4 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
        //     5 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D4418FI-CAF(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     6 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42C08-H', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     7 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42MF2B', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     8 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-S11L', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     9 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HI', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     10 => array('room_id' => '1', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HO', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     11 => array('room_id' => '1', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
        //     12 => array('room_id' => '1', 'name' => 'อุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติ', 'count' => '18'),
        //     13 => array('room_id' => '1', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '3'),
        //     14 => array('room_id' => '1', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '3'),
        //     15 => array('room_id' => '1', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '2'),
        //     16 => array('room_id' => '1', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉินภายในโรงเรือนสำหรับหน้าต่าง 6 บาน', 'count' => '1'),
        //     17 => array('room_id' => '1', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
        //     18 => array('room_id' => '1', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
        //     19 => array('room_id' => '3', 'name' => 'ปลอกคอ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายห้อยคอสำหรับตรวจสอบพฤติกรรมวัวสำหรับโคเนื้อและกระบือ พร้อมเครื่องรับสัญญาณหลัก', 'count' => '40'),
        //     20 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
        //     21 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D4418FI-CAF(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     22 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42C08-H', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     23 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42MF2B', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     24 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-S11L', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     25 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HI', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     26 => array('room_id' => '3', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HO', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     27 => array('room_id' => '3', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
        //     28 => array('room_id' => '3', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน (1 ตัว ได้ 3 ดับ)', 'count' => '2'),
        //     29 => array('room_id' => '3', 'name' => 'อุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติ', 'count' => '6'),
        //     30 => array('room_id' => '3', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉินภายในโรงเรือนสำหรับหน้าต่าง 6 บาน', 'count' => '1'),
        //     31 => array('room_id' => '3', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
        //     32 => array('room_id' => '3', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '3'),
        //     33 => array('room_id' => '3', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '3'),
        //     34 => array('room_id' => '3', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
        //     35 => array('room_id' => '5', 'name' => 'สายคล้องคอ', 'name_en' => 'RFID Tag', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายคล้องสำหรับระบุตัวตนสัตว์ภายในโรงเรือน', 'count' => '24'),
        //     36 => array('room_id' => '5', 'name' => 'อุปกรณ์บันทึกการให้น้ำ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติเชื่อมต่อกับสายคล้องคอ', 'count' => '24'),
        //     37 => array('room_id' => '5', 'name' => 'อุปกรณ์รีดนมแพะ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์รีดนมแพะพร้อมระบบบันทึกปริมาณนมอัตโนมัติเชื่อมต่อกับสายคล้องคอ', 'count' => '4'),
        //     38 => array('room_id' => '5', 'name' => 'เครื่องชั่งน้ำหนัก', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'เครื่องชั่งน้ำหนักสัตว์ขนาดไม่เกิน 200 กิโลกรัม พร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
        //     39 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
        //     40 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D4418FI-CAF(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     41 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42C08-H', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     42 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42MF2B', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     43 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-S11L', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     44 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HI', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     45 => array('room_id' => '5', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HO', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     46 => array('room_id' => '5', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
        //     47 => array('room_id' => '5', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '1'),
        //     48 => array('room_id' => '5', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉินภายในโรงเรือนสำหรับหน้าต่าง 5 บาน', 'count' => '1'),
        //     49 => array('room_id' => '5', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '2'),
        //     50 => array('room_id' => '5', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '6'),
        //     51 => array('room_id' => '5', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
        //     52 => array('room_id' => '5', 'name' => 'พัดลมระบายอากาศ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศภายในฟาร์มขนาด 12 นิ้ว', 'count' => '6'),
        //     53 => array('room_id' => '5', 'name' => 'พัดลมกระจายความร้อน', 'name_en' => 'Heater', 'brand' => '', 'model' => '', 'description' => 'พัดลมกระจายความร้อน (Heater)', 'count' => '3'),
        //     54 => array('room_id' => '5', 'name' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'count' => '3'),
        //     55 => array('room_id' => '5', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
        //     56 => array('room_id' => '5', 'name' => 'อุปกรณ์ตรวจวัดปริมาณแก๊สแอมโมเนีย', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดปริมาณแก๊สแอมโมเนีย', 'count' => '2'),
        //     57 => array('room_id' => '7', 'name' => 'สายคล้องคอ', 'name_en' => 'RFID Tag', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายคล้องสำหรับระบุตัวตนสัตว์ภายในโรงเรือน Tag ติดหูหมู', 'count' => '50'),
        //     58 => array('room_id' => '7', 'name' => 'อุปกรณ์บันทึกการให้น้ำ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
        //     59 => array('room_id' => '7', 'name' => 'อุปกรณ์กกสุกร', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์กกสุกรพร้อมระบบควบคุมอุณหภูมิ (Heater)', 'count' => '8'),
        //     60 => array('room_id' => '7', 'name' => 'เครื่องชั่งน้ำหนัก', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'เครื่องชั่งน้ำหนักสัตว์ขนาดไม่เกิน 500 กิโลกรัม พร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ(เอาราคาอ้างอิง x3)', 'count' => '1'),
        //     61 => array('room_id' => '7', 'name' => 'อุปกรณ์วัดขนาดสุกร', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์วัดขนาดสุกรพร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
        //     62 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
        //     63 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D4418FI-CAF(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     64 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42C08-H', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     65 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42MF2B', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     66 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-S11L', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     67 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HI', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     68 => array('room_id' => '7', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HO', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     69 => array('room_id' => '7', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '1'),
        //     70 => array('room_id' => '7', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
        //     71 => array('room_id' => '7', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '3'),
        //     72 => array('room_id' => '7', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'count' => '1'),
        //     73 => array('room_id' => '7', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '3'),
        //     74 => array('room_id' => '7', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '3'),
        //     75 => array('room_id' => '7', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
        //     76 => array('room_id' => '8', 'name' => 'เครื่องชั่งน้ำหนัก', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'เครื่องชั่งน้ำหนักพร้อมระบบบันทึกข้อมูลประจำตัวไก่ ขนาดพิกัด 5 กิโลกรัม', 'count' => '2'),
        //     77 => array('room_id' => '8', 'name' => 'สายคล้องคอ', 'name_en' => 'RFID Tag', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายคล้องสำหรับระบุตัวตนสัตว์ภายในโรงเรือน', 'count' => '156'),
        //     78 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
        //     79 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D4418FI-CAF(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     80 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42C08-H', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     81 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-D42MF2B', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     82 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-S11L', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     83 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HI', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     84 => array('room_id' => '8', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-C30S-04HO', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '1'),
        //     85 => array('room_id' => '8', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
        //     86 => array('room_id' => '8', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '4'),
        //     87 => array('room_id' => '8', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'count' => '1'),
        //     88 => array('room_id' => '8', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '2'),
        //     89 => array('room_id' => '8', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '4'),
        //     90 => array('room_id' => '8', 'name' => 'พัดลมระบายอากาศ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศภายในฟาร์มขนาด 12 นิ้ว', 'count' => '6'),
        //     91 => array('room_id' => '8', 'name' => 'พัดลมกระจายความร้อน', 'name_en' => 'Heater', 'brand' => '', 'model' => '', 'description' => 'พัดลมกระจายความร้อน (Heater)', 'count' => '3'),
        //     92 => array('room_id' => '8', 'name' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'count' => '3'),
        //     93 => array('room_id' => '8', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
        //     //94 => array('room_id' => '8', 'name' => 'ระบบลำเลียงอาหารอัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ระบบลำเลียงอาหารอัตโนมัติ', 'count' => '1'),
        // );

        $devices = array(
            0 => array('room_id' => '', 'device_type_id' => '26', 'name' => 'ปลอกคอ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายห้อยคอสำหรับตรวจสอบพฤติกรรมวัวสำหรับโคนม พร้อมโปรแกรมบันทึกสถิติและเครื่องรับสัญญาณหลัก', 'count' => '15'),
            1 => array('room_id' => '', 'device_type_id' => '27', 'name' => 'เครื่องรีดนม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์รีดนมวัวพร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '3'),
            2 => array('room_id' => '', 'device_type_id' => '28', 'name' => 'เครื่องชั่งน้ำหนักวัว', 'name_en' => 'Dynaweight', 'brand' => 'Dynaweight', 'model' => 'DW-218', 'description' => 'เครื่องชั่งน้ำหนักวัวขนาดไม่เกิน 2 ตัน ขนาด 90(W)x180(L)x180(H)cm. อ่านค่าละเอียดที่ 1kg พร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
            3 => array('room_id' => '', 'device_type_id' => '29', 'name' => 'อุปกรณ์วัดขนาดโคนม', 'name_en' => 'Camera + Housing', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์วัดขนาดโคนมพร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
            4 => array('room_id' => '1', 'device_type_id' => '37', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
            5 => array('room_id' => '1', 'device_type_id' => '34', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
            6 => array('room_id' => '1', 'device_type_id' => '30', 'name' => 'อุปกรณ์บันทึกการให้น้ำอัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติ', 'count' => '18'),
            7 => array('room_id' => '1', 'device_type_id' => '9', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '3'),
            8 => array('room_id' => '1', 'device_type_id' => '31', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '3'),
            9 => array('room_id' => '1', 'device_type_id' => '7', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '2'),
            10 => array('room_id' => '1', 'device_type_id' => '32', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉินภายในโรงเรือนสำหรับหน้าต่าง 6 บาน', 'count' => '1'),
            11 => array('room_id' => '1', 'device_type_id' => '14', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
            12 => array('room_id' => '1', 'device_type_id' => '33', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
            13 => array('room_id' => '', 'device_type_id' => '26', 'name' => 'ปลอกคอ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายห้อยคอสำหรับตรวจสอบพฤติกรรมวัวสำหรับโคเนื้อและกระบือ พร้อมเครื่องรับสัญญาณหลัก', 'count' => '40'),
            14 => array('room_id' => '3', 'device_type_id' => '37', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
            15 => array('room_id' => '3', 'device_type_id' => '34', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
            16 => array('room_id' => '3', 'device_type_id' => '7', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน (1 ตัว ได้ 3 ดับ)', 'count' => '2'),
            17 => array('room_id' => '3', 'device_type_id' => '30', 'name' => 'อุปกรณ์บันทึกการให้น้ำอัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติ', 'count' => '6'),
            18 => array('room_id' => '3', 'device_type_id' => '32', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉินภายในโรงเรือนสำหรับหน้าต่าง 6 บาน', 'count' => '1'),
            19 => array('room_id' => '3', 'device_type_id' => '14', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
            20 => array('room_id' => '3', 'device_type_id' => '9', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '3'),
            21 => array('room_id' => '3', 'device_type_id' => '31', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '3'),
            22 => array('room_id' => '3', 'device_type_id' => '33', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
            23 => array('room_id' => '', 'device_type_id' => '26', 'name' => 'สายคล้องคอ', 'name_en' => 'RFID Tag', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายคล้องสำหรับระบุตัวตนสัตว์ภายในโรงเรือน', 'count' => '24'),
            24 => array('room_id' => '5', 'device_type_id' => '30', 'name' => 'อุปกรณ์บันทึกการให้น้ำอัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติเชื่อมต่อกับสายคล้องคอ', 'count' => '24'),
            25 => array('room_id' => '', 'device_type_id' => '27', 'name' => 'อุปกรณ์รีดนมแพะ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์รีดนมแพะพร้อมระบบบันทึกปริมาณนมอัตโนมัติเชื่อมต่อกับสายคล้องคอ', 'count' => '4'),
            26 => array('room_id' => '', 'device_type_id' => '28', 'name' => 'เครื่องชั่งน้ำหนักแพะ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'เครื่องชั่งน้ำหนักสัตว์ขนาดไม่เกิน 200 กิโลกรัม พร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
            27 => array('room_id' => '5', 'device_type_id' => '37', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
            28 => array('room_id' => '5', 'device_type_id' => '34', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
            29 => array('room_id' => '5', 'device_type_id' => '7', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '1'),
            30 => array('room_id' => '5', 'device_type_id' => '32', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉินภายในโรงเรือนสำหรับหน้าต่าง 5 บาน', 'count' => '1'),
            31 => array('room_id' => '5', 'device_type_id' => '9', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '2'),
            32 => array('room_id' => '5', 'device_type_id' => '31', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '6'),
            33 => array('room_id' => '5', 'device_type_id' => '14', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
            34 => array('room_id' => '5', 'device_type_id' => '9', 'name' => 'พัดลมระบายอากาศ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศภายในฟาร์มขนาด 12 นิ้ว', 'count' => '6'),
            35 => array('room_id' => '5', 'device_type_id' => '9', 'name' => 'พัดลมกระจายความร้อน', 'name_en' => 'Heater', 'brand' => '', 'model' => '', 'description' => 'พัดลมกระจายความร้อน (Heater)', 'count' => '3'),
            36 => array('room_id' => '5', 'device_type_id' => '35', 'name' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'count' => '3'),
            37 => array('room_id' => '5', 'device_type_id' => '33', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
            38 => array('room_id' => '5', 'device_type_id' => '36', 'name' => 'อุปกรณ์ตรวจวัดปริมาณแก๊สแอมโมเนีย', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดปริมาณแก๊สแอมโมเนีย', 'count' => '2'),
            39 => array('room_id' => '', 'device_type_id' => '26', 'name' => 'สายคล้องคอ', 'name_en' => 'RFID Tag', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายคล้องสำหรับระบุตัวตนสัตว์ภายในโรงเรือน Tag ติดหูหมู', 'count' => '50'),
            40 => array('room_id' => '7', 'device_type_id' => '30', 'name' => 'อุปกรณ์บันทึกการให้น้ำอัตโนมัติ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์บันทึกการให้น้ำปศุสัตว์อัตโนมัติเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
            41 => array('room_id' => '7', 'device_type_id' => '38', 'name' => 'อุปกรณ์กกสุกร', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์กกสุกรพร้อมระบบควบคุมอุณหภูมิ (Heater)', 'count' => '8'),
            42 => array('room_id' => '', 'device_type_id' => '28', 'name' => 'เครื่องชั่งน้ำหนักสุกร', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'เครื่องชั่งน้ำหนักสัตว์ขนาดไม่เกิน 500 กิโลกรัม พร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ(เอาราคาอ้างอิง x3)', 'count' => '1'),
            43 => array('room_id' => '', 'device_type_id' => '29', 'name' => 'อุปกรณ์วัดขนาดสุกร', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'ชุดอุปกรณ์วัดขนาดสุกรพร้อมระบบบันทึกเชื่อมต่อกับสายคล้องคอ', 'count' => '1'),
            44 => array('room_id' => '7', 'device_type_id' => '37', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
            45 => array('room_id' => '7', 'device_type_id' => '34', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '1'),
            46 => array('room_id' => '7', 'device_type_id' => '14', 'name' => 'ประตูบานเลื่อนอัตโนมัติ', 'name_en' => 'Automatic Control', 'brand' => '', 'model' => '', 'description' => 'Automatic Control แบบ 2 บานเปิด', 'count' => '1'),
            47 => array('room_id' => '7', 'device_type_id' => '7', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '3'),
            48 => array('room_id' => '7', 'device_type_id' => '32', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'count' => '1'),
            49 => array('room_id' => '7', 'device_type_id' => '9', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '3'),
            50 => array('room_id' => '7', 'device_type_id' => '31', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '3'),
            51 => array('room_id' => '7', 'device_type_id' => '33', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
            52 => array('room_id' => '', 'device_type_id' => '28', 'name' => 'เครื่องชั่งน้ำหนักไก่', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'เครื่องชั่งน้ำหนักพร้อมระบบบันทึกข้อมูลประจำตัวไก่ ขนาดพิกัด 5 กิโลกรัม', 'count' => '2'),
            53 => array('room_id' => '', 'device_type_id' => '26', 'name' => 'สายคล้องคอ', 'name_en' => 'RFID Tag', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์สายคล้องสำหรับระบุตัวตนสัตว์ภายในโรงเรือน', 'count' => '156'),
            54 => array('room_id' => '8', 'device_type_id' => '37', 'name' => 'กล้องตรวจจับอุณหภูมิ', 'name_en' => 'Hikvision', 'brand' => 'Hikvision', 'model' => 'DS-2TD1217B-6/PA(B)', 'description' => 'กล้องตรวจจับอุณหภูมิร่างกายสำหรับระบบตรวจวัดสุขภาพปศุสัตว์', 'count' => '2'),
            55 => array('room_id' => '8', 'device_type_id' => '34', 'name' => 'อุปกรณ์ตรวจวัดการใช้พลังงาน', 'name_en' => 'Schneider', 'brand' => 'Schneider', 'model' => 'Schneider PM2230', 'description' => 'อุปกรณ์ตรวจวัดการใช้พลังงานภายในโรงเรือน', 'count' => '2'),
            56 => array('room_id' => '8', 'device_type_id' => '7', 'name' => 'อุปกรณ์ควบคุมแสงสว่าง', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมแสงสว่างภายในโรงเรือน', 'count' => '4'),
            57 => array('room_id' => '8', 'device_type_id' => '32', 'name' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมการระบายอากาศฉุกเฉิน', 'count' => '1'),
            58 => array('room_id' => '8', 'device_type_id' => '9', 'name' => 'พัดลมฟาร์ม', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศ 44" ใบพัดสแตนเลส 430 ( ใบพัด 6 ใบ ) พร้อมระบบควบคุมอัตโนมัติ', 'count' => '2'),
            59 => array('room_id' => '8', 'device_type_id' => '31', 'name' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อม', 'name_en' => 'General Environmental Sensor + Airflow', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ตรวจวัดสภาพแวดล้อมภายในโรงเรือนเลี้ยงสัตว์', 'count' => '4'),
            60 => array('room_id' => '8', 'device_type_id' => '9', 'name' => 'พัดลมระบายอากาศ', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'พัดลมระบายอากาศภายในฟาร์มขนาด 12 นิ้ว', 'count' => '6'),
            61 => array('room_id' => '8', 'device_type_id' => '9', 'name' => 'พัดลมกระจายความร้อน', 'name_en' => 'Heater', 'brand' => '', 'model' => '', 'description' => 'พัดลมกระจายความร้อน (Heater)', 'count' => '3'),
            62 => array('room_id' => '8', 'device_type_id' => '32', 'name' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'name_en' => '', 'brand' => '', 'model' => '', 'description' => 'อุปกรณ์ควบคุมพัดลมกระจายความร้อน', 'count' => '3'),
            63 => array('room_id' => '8', 'device_type_id' => '33', 'name' => 'อุปกรณ์ควบคุมการทำงานระบบทำความเย็น', 'name_en' => 'Evaporative Cooling System', 'brand' => 'EVAP Aircool', 'model' => '', 'description' => 'ชุดอุปกรณ์เครื่อง EVAP Aircool และระบบควบคุมการทำงานระบบทำความเย็นภายในโรงเรือนแบบ Evaporative Cooling System', 'count' => '1'),
        );

        $n = 1;
        
        foreach ($devices as $key => $value) {
            // $value['device_type_id'] = 1;
            $value['created_by'] = 1;
            $value['visible'] = 1;
            $value['display_status'] = 'hover';
            $value['x'] = rand(10, 50);
            $value['y'] = rand(10, 50);
            if (strlen($value['room_id']) == 0) {
                $value['room_id'] = NULL;
            }
            $count = (int)$value['count'];
            unset($value['count']);
            if ($count > 1 && $value['brand'] != 'Schneider') {
                for ($i = 1; $i <= $count; $i++) {
                    $device = $value;
                    // if ((int)$value['room_id'] <= 8 && $value['device_type_id'] == '37') {
                    //     $id = (int)$value['room_id'];
                    //     $device['room_id'] = $id + 1;
                    // }
                    $device['name'] = $value['name'] . " " . $i;
                    if (strlen($value['name_en']) > 0) {
                        $device['name_en'] = $value['name_en'] . " " . $i;
                    }
                    $d = App\Device::create($device);
                }
            } else {
                if ($value['brand'] == 'Schneider') {
                    for ($i = 1; $i <= $count; $i++) {
                        $device = $value;
                        $device['room_id'] =  $n;
                        $device['name'] = "มิเตอร์ " . $n;
                        $device['model'] = preg_replace('/\s+/', '_', $value['model'] . " " . $n);
                        $meter = array('active_license' => 1, 'Label' => $device['name'], 'TokenGuid' => strtoupper($device['model']), 'Status' => '1', 'Notify' => '1', 'room' => $device['room_id'], 'area' => 1, 'building' => 1);
                        App\Meter::create($meter);
                        $n++;
                    }
                } else {
                    $d = App\Device::create($value);
                }
            }

        }

        // $meters = array(
        //     0 => array('active_license' => 1, 'Label' => 'LannaCom PM2130', 'TokenGuid' => 'LCPM2130', 'Status' => '1', 'Notify' => '1'),
        //     1 => array('active_license' => 1, 'Label' => 'LannaComm A9MEM1570_1', 'TokenGuid' => 'LCA9MEM1570_2', 'Status' => '0', 'Notify' => '1'),
        //     2 => array('active_license' => 1, 'Label' => 'LannaComm A9MEM1570_2', 'TokenGuid' => 'LCA9MEM1570_3', 'Status' => '0', 'Notify' => '1'),
        //     3 => array('active_license' => 1, 'Label' => 'LannaComm A9MEM1520_1', 'TokenGuid' => 'LCA9MEM1520_4', 'Status' => '0', 'Notify' => '1'),
        //     4 => array('active_license' => 1, 'Label' => 'LannaCom wt0001', 'TokenGuid' => 'WT0001', 'Status' => '0', 'Notify' => '1'),
        //     5 => array('active_license' => 1, 'Label' => 'LannaComGas', 'TokenGuid' => 'GS0001', 'Status' => '0', 'Notify' => '1'),
        // );

        // foreach ($meters as $key => $value) {
        //     App\Meter::create($value);
        // }
    }
}
